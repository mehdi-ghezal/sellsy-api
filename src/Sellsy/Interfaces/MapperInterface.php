<?php

namespace Sellsy\Interfaces;

use Sellsy\Collections\Collection;

/**
 * Interface MapperInterface
 * @package Sellsy\Mappers
 */
interface MapperInterface
{
    /**
     * @param $object
     * @param $response
     * @return mixed
     */
    public function mapObject($object, $response);
}