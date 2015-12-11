<?php

namespace Sellsy\Tests\Fixtures;

use Minime\Annotations\Cache\ArrayCache;
use Minime\Annotations\Parser;
use Minime\Annotations\Reader;
use Sellsy\Adapters\BaseAdapter;
use Sellsy\Mappers\BaseMapper;
use Sellsy\Tests\Fixtures\Credentials;
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
            $mapper = new BaseMapper($reader);

            $adapter = new BaseAdapter(Credentials::$consumerToken, Credentials::$consumerSecret, Credentials::$userToken, Credentials::$userSecret);
            $adapter->setMapper($mapper);

            self::$validClient = new Client($adapter);
        }

        return self::$validClient;
    }
}