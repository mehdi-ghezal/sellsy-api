<?php

namespace Sellsy\Interfaces;

use Sellsy\Criteria\Order;
use Sellsy\Criteria\Paginator;

/**
 * Interface AdapterInterface
 * @package Sellsy\Interfaces
 */
interface AdapterInterface
{
    /**
     * @param mixed $object
     * @return $this
     */
    public function map($object);

    /**
     * @param $method
     * @param CriteriaInterface|null $criteria
     * @param Order|null $order
     * @param Paginator|null $paginator
     * @return mixed
     */
    public function call($method, CriteriaInterface $criteria = null, Order $order = null , Paginator $paginator = null);
}