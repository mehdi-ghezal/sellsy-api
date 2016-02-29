<?php

namespace Sellsy\Adapters;

use Sellsy\Collections\Collection;
use Sellsy\Criteria\Order;
use Sellsy\Criteria\Paginator;
use Sellsy\Exception\RuntimeException;
use Sellsy\Criteria\CriteriaInterface;
use Sellsy\Mappers\MapperInterface;
use Sellsy\Transports\TransportInterface;

/**
 * Class MapperAdapter
 * @package Sellsy\Adapters
 */
class MapperAdapter implements AdapterInterface
{
    /**
     * @var TransportInterface
     */
    protected $transport;

    /**
     * @var MapperInterface
     */
    protected $mapper;

    /**
     * @var mixed
     */
    protected $subject;

    /**
     * MapperAdapter constructor.
     *
     * @param TransportInterface $transport
     * @param MapperInterface $mapper
     */
    public function __construct(TransportInterface $transport, MapperInterface $mapper)
    {
        $this->transport = $transport;
        $this->mapper = $mapper;
    }

    /**
     * @param mixed $object
     * @return $this
     */
    public function map($object)
    {
        $this->subject = $object;
        return $this;
    }

    /**
     * @param $method
     * @param CriteriaInterface|null $criteria
     * @param Order|null $order
     * @param Paginator|null $paginator
     * @return mixed
     * @throws \Sellsy\Exception\RuntimeException
     * @throws \Exception
     */
    public function call($method, CriteriaInterface $criteria = null, Order $order = null, Paginator $paginator = null)
    {
        // Ensure to clean subject, @see finally
        try {
            // Subject is required with this Adapter
            if (! $this->subject) {
                throw new RuntimeException('No subject mapped, you must call "map" method before use the "call" method');
            }

            // Send API Call with the transport
            $apiResult = $this->transport->call(array(
                'method' => $method,
                'params' => array_merge(
                    $criteria ? $criteria->getParameters() : array(),
                    $order ? $order->getParameters() : array(),
                    $paginator ? $paginator->getParameters() : array()
                )
            ));

            // API Call that return a collection
            if (isset($apiResult['response']['result'])) {
                // Update paginator from API Response
                $paginator = $paginator ?: new Paginator();
                $paginator->setPageNumber($apiResult['response']['infos']['pagenum']);
                $paginator->setNumberPerPage($apiResult['response']['infos']['nbperpage']);
                $paginator->setNumberOfPages($apiResult['response']['infos']['nbpages']);
                $paginator->setNumberOfResults($apiResult['response']['infos']['nbtotal']);

                // Initialize items
                $items = array();

                // Map objects
                foreach($apiResult['response']['result'] as $value) {
                    $items[] = $this->mapper->mapObject($this->subject, $value);
                }

                $result = new Collection(array(
                    'items' => $items,
                    'adapter' => $this,
                    'method' => $method,
                    'subject' => $this->subject,
                    'paginator' => $paginator,
                    'criteria' => $criteria,
                    'order' => $order
                ));
            }

            // API Call that return an object
            else {
                $result = $this->mapper->mapObject($this->subject, $apiResult['response']);
            }
        }

        // Throw catched exception
        catch(\Exception $e) {
            throw $e;
        }

        // Reset subject for next call
        finally {
            $this->subject = null;
        }

        return $result;
    }
}