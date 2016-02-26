<?php

namespace Sellsy\Tests\Fixtures;

use Concat\Http\Middleware\Logger as MiddlewareLogger;
use Minime\Annotations\Cache\ArrayCache;
use Minime\Annotations\Parser;
use Minime\Annotations\Reader;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Sellsy\Adapters\MapperAdapter;
use Sellsy\Transports\Guzzle;
use Sellsy\Mappers\MinimeMapper;
use Sellsy\Client;
use Sellsy\Models\Catalogue\ItemInterface;

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
            $mapper->setInterfaceMapping(ItemInterface::class, NewItem::class);

            $stream = new StreamHandler(sprintf(dirname(__DIR__) . '/Logs/%s.log', date(DATE_ATOM)));
            $stream->setFormatter(new LineFormatter("[%datetime%] %channel%.%level_name%: %message% \n\n", null, true));

            $logger = new Logger('Logger');
            $logger->pushHandler($stream);

            $middlewareLogger = new MiddlewareLogger($logger, function ( $request, $response, $reason) {
                $space = '    ';
                $template = PHP_EOL . $space . 'Request uri: %s' .
                            PHP_EOL . $space . 'Request method: %s' .
                            PHP_EOL . $space . 'Request body:' .
                            PHP_EOL . $space . $space . '%s' .
                            PHP_EOL . $space . 'Response status: %s' .
                            PHP_EOL . $space . 'Response body:' .
                            PHP_EOL . $space . $space . '%s';

                return sprintf(
                    $template,
                    $request->getUri(),
                    $request->getMethod(),
                    str_replace(PHP_EOL, PHP_EOL . $space . $space, var_export($request->getBody()->__toString(), true)),
                    $response->getStatusCode(),
                    str_replace(PHP_EOL, PHP_EOL . $space . $space, json_encode(json_decode($response->getBody()->__toString()), JSON_PRETTY_PRINT))
                );
            });

            $transport = new Guzzle(Credentials::$consumerToken, Credentials::$consumerSecret, Credentials::$userToken, Credentials::$userSecret);
            $transport->registerMiddleware($middlewareLogger);

            self::$validClient = new Client(new MapperAdapter($transport, $mapper));

        }

        return self::$validClient;
    }
}