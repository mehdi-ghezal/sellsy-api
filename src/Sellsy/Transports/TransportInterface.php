<?php

namespace Sellsy\Transports;

/**
 * Interface TransportInterface
 * @package Sellsy\Transports
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
     */
    public function call(array $requestSettings);

    /**
     * @param string $consumerToken
     * @param string $consumerSecret
     * @param string $userToken
     * @param string $userSecret
     * @return TransportInterface
     */
    public function overrideAuthentication($consumerToken, $consumerSecret, $userToken, $userSecret);
}