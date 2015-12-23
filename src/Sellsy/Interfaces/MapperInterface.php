<?php

namespace Sellsy\Interfaces;

/**
 * Interface MapperInterface
 * @package Sellsy\Mappers
 */
interface MapperInterface
{
    /**
     * @param $object
     * @param array $data
     * @return mixed
     */
    public function mapObject($object, array $data);
}