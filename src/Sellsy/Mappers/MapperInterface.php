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
     * @param string $interface
     * @param string $context
     * @param array $data
     * @return mixed
     */
    public function mapObject($interface, $context, array $data);
}