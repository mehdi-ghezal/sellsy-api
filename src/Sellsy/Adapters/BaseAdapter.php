<?php

namespace Sellsy\Adapters;

use Sellsy\Collections\Collection;
use Sellsy\Criteria\Order;
use Sellsy\Criteria\Paginator;
use Sellsy\Criteria\CriteriaInterface;
use Sellsy\Transports\TransportInterface;

/**
 * Class BaseAdapter
 * @package Sellsy\Adapters
 */
class BaseAdapter implements AdapterInterface
{
    /**
     * @var TransportInterface
     */
    protected $transport;

    /**
     * BaseAdapter constructor.
     *
     * @param TransportInterface $transport
     */
    public function __construct(TransportInterface $transport)
    {
        $this->transport = $transport;
    }

    /**
     * @param mixed $object
     * @return $this
     */
    public function map($object)
    {
        return $this;
    }

    /**
     * @param $method
     * @param CriteriaInterface|null $criteria
     * @param Order|null $order
     * @param Paginator|null $paginator
     * @return array
     */
    public function call($method, CriteriaInterface $criteria = null, Order $order = null, Paginator $paginator = null)
    {
        $result = $this->transport->call(array(
            'method' => $method,
            'params' => array_merge(
                $criteria ? $criteria->getParameters() : array(),
                $order ? $order->getParameters() : array(),
                $paginator ? $paginator->getParameters() : array()
            )
        ));

        // API Call that return a collection
        if (isset($result['response']['result'])) {
            // Update paginator from API Response
            $paginator = $paginator ?: new Paginator();
            $paginator->setPageNumber($result['response']['infos']['pagenum']);
            $paginator->setNumberPerPage($result['response']['infos']['nbperpage']);
            $paginator->setNumberOfPages($result['response']['infos']['nbpages']);
            $paginator->setNumberOfResults($result['response']['infos']['nbtotal']);

            // Initialize items
            $items = array();

            // Map objects
            foreach($result['response']['result'] as $value) {
                $items[] = $value;
            }

            $result = new Collection(array(
                'items' => $items,
                'adapter' => $this,
                'method' => $method,
                'paginator' => $paginator,
                'criteria' => $criteria,
                'order' => $order
            ));
        }

        return $result;
    }
}