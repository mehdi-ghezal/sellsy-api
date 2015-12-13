<?php

namespace Sellsy\Tests\Fixtures;

use Minime\Annotations\Cache\ArrayCache;
use Minime\Annotations\Parser;
use Minime\Annotations\Reader;
use Sellsy\Adapters\MapperAdapter;
use Sellsy\Transports\Httpful;
use Sellsy\Mappers\MinimeMapper;
use Sellsy\Client;

/**
 * Class Clients
 * @package Sellsy\Tests\Fixtures
 */
class Clients
{
    /**
     * @var Client
     */
    protected static $validClient;

    /**
     * @return Client
     */
    public static function getValidClient()
    {
        if (!self::$validClient) {
            $reader = new Reader(new Parser(), new ArrayCache());
            $mapper = new MinimeMapper($reader);

            $transport = new Httpful(Credentials::$consumerToken, Credentials::$consumerSecret, Credentials::$userToken, Credentials::$userSecret);

            self::$validClient = new Client(new MapperAdapter($transport, $mapper));
        }

        return self::$validClient;
    }
}