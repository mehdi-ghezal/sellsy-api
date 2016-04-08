<?php

namespace Sellsy\Adapters;

use Psr\Log\LoggerAwareInterface;
use Sellsy\Criteria\CriteriaInterface;
use Sellsy\Criteria\Paginator;
use Sellsy\Transports\TransportInterface;

/**
 * Interface AdapterInterface
 *
 * @package Sellsy\Adapters
 */
interface AdapterInterface extends LoggerAwareInterface
{
    /**
     * @return TransportInterface
     */
    public function getTransport();

    /**
     * @param string $interface
     * @param string $context
     * @return $this
     */
    public function map($interface, $context);

    /**
     * @param $method
     * @param CriteriaInterface|null $criteria
     * @param Paginator|null $paginator
     * @return mixed
     */
    public function call($method, CriteriaInterface $criteria = null, Paginator $paginator = null);
}