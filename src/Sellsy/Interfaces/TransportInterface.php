<?php

namespace Sellsy\Interfaces;

/**
 * Interface TransportInterface
 * @package Sellsy\Interfaces
 */
interface TransportInterface
{
    /**
     * @var string
     */
    const API_ENDPOINT = "https://apifeed.sellsy.com/0/";

    /**
     * @param array $requestSettings
     * @return array
     * @throws \Sellsy\Exception\ServerException
     */
    public function call(array $requestSettings);
}