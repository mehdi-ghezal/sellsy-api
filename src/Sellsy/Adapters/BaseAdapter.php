<?php

namespace Sellsy\Adapters;

use Sellsy\Criteria\Order;
use Sellsy\Criteria\Paginator;
use Sellsy\Interfaces\AdapterInterface;
use Sellsy\Interfaces\CriteriaInterface;
use Sellsy\Interfaces\TransportInterface;

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
     * @return mixed
     */
    public function call($method, CriteriaInterface $criteria = null, Order $order = null, Paginator $paginator = null)
    {
        return $this->transport->call(array(
            'method' => $method,
            'params' => array_merge(
                $criteria ? $criteria->getParameters() : array(),
                $order ? $order->getParameters() : array(),
                $paginator ? $paginator->getParameters() : array()
            )
        ));
    }
}