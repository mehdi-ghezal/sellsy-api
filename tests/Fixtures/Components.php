<?php

namespace Sellsy\Tests\Fixtures;

use Minime\Annotations\Cache\ArrayCache;
use Minime\Annotations\Parser;
use Minime\Annotations\Reader;
use Sellsy\Adapters\AdapterInterface;
use Sellsy\Adapters\MapperAdapter;
use Sellsy\Mappers\MapperInterface;
use Sellsy\Tests\Mock\LocalTransport;
use Sellsy\Transports\Guzzle;
use Sellsy\Mappers\MinimeMapper;
use Sellsy\Client;
use Sellsy\Transports\TransportInterface;

/**
 * Class Components
 *
 * @package Sellsy\Tests\Fixtures
 */
class Components
{
    /**
     * @var MapperInterface
     */
    protected static $mapper;

    /**
     * @var TransportInterface
     */
    protected static $transport;

    /**
     * @var AdapterInterface
     */
    protected static $adapter;

    /**
     * @var Client
     */
    protected static $client;

    /**
     * @return MapperInterface|MinimeMapper
     */
    public static function getMapper()
    {
        if (! self::$mapper) {
            self::$mapper = new MinimeMapper(new Reader(new Parser(), new ArrayCache()));
        }

        return self::$mapper;
    }

    /**
     * @return LocalTransport|TransportInterface
     */
    public static function getTransport()
    {
        if (! self::$transport) {
            self::$transport = new LocalTransport();

            /** @noinspection PhpUndefinedConstantInspection */
            if (SELLSY_CONSUMER_TOKEN && SELLSY_CONSUMER_SECRET && SELLSY_USER_TOKEN && SELLSY_USER_SECRET) {
                /** @noinspection PhpUndefinedConstantInspection */
                self::$transport->setRealTransport(new Guzzle(
                        SELLSY_CONSUMER_TOKEN,
                        SELLSY_CONSUMER_SECRET,
                        SELLSY_USER_TOKEN,
                        SELLSY_USER_SECRET
                ));
            }
        }

        return self::$transport;
    }

    /**
     * @return AdapterInterface|MapperAdapter
     */
    public static function getAdapter()
    {
        if (! self::$adapter) {
            self::$adapter = new MapperAdapter(self::getTransport(), self::getMapper());
        }

        return self::$adapter;
    }

    /**
     * @return Client
     */
    public static function getClient()
    {
        if (!self::$client) {
            self::$client = new Client(self::getAdapter());
        }

        return self::$client;
    }
}