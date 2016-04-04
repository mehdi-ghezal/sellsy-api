<?php

namespace Sellsy\Adapters;

use Sellsy\Criteria\CriteriaInterface;
use Sellsy\Criteria\Paginator;
use Sellsy\Transports\TransportInterface;

/**
 * Interface AdapterInterface
 * @package Sellsy\Adapters
 */
interface AdapterInterface
{
    /**
     * @return TransportInterface
     */
    public function getTransport();

    /**
     * @param mixed $object
     * @return $this
     */
    public function map($object);

    /**
     * @param $method
     * @param CriteriaInterface|null $criteria
     * @param Paginator|null $paginator
     * @return mixed
     */
    public function call($method, CriteriaInterface $criteria = null, Paginator $paginator = null);
}