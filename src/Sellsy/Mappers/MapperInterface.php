<?php

namespace Sellsy\Mappers;

/**
 * Interface MapperInterface
 * @package Sellsy\Mappers
 */
interface MapperInterface
{
    /**
     * @param $interface
     * @param array $data
     * @return mixed
     */
    public function mapObject($interface, array $data);
}