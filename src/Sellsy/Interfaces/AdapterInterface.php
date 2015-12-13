<?php

namespace Sellsy\Interfaces;

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
     * @param array $requestSettings
     * @return mixed
     */
    public function call(array $requestSettings);
}