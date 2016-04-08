<?php

namespace Sellsy\Mappers;

use Psr\Log\LoggerAwareInterface;

/**
 * Interface MapperInterface
 *
 * @package Sellsy\Mappers
 */
interface MapperInterface extends LoggerAwareInterface
{
    /**
     * @param $interface
     * @param array $data
     * @return mixed
     */
    public function mapObject($interface, array $data);
}