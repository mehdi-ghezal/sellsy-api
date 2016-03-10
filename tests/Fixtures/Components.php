<?php

namespace Sellsy\Tests\Fixtures;

use GuzzleHttp\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Sellsy\Adapters\AdapterInterface;
use Sellsy\Adapters\MapperAdapter;
use Sellsy\Api;
use Sellsy\Mappers\MapperInterface;
use Sellsy\Mappers\YmlMapper;
use Sellsy\Tests\Mock\LocalTransport;
use Sellsy\Transports\Guzzle;
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
     * @var Api
     */
    protected static $api;

    /**
     * @return MapperInterface|YmlMapper
     */
    public static function getMapper()
    {
        if (! self::$mapper) {
            self::$mapper = new YmlMapper();
        }

        return self::$mapper;
    }

    /**
     * @return LocalTransport|TransportInterface
     */
    public static function getTransport()
    {
        if (! self::$transport) {
            /** @noinspection PhpUndefinedConstantInspection */
            self::$transport = new LocalTransport(CACHE_ENABLED);

            if ($realTransport = self::getRealTransport()) {
                self::$transport->setRealTransport($realTransport);
            }
        }

        return self::$transport;
    }

    /**
     * @return Guzzle
     */
    public static function getRealTransport()
    {
        /** @noinspection PhpUndefinedConstantInspection */
        if (! SELLSY_CONSUMER_TOKEN || !SELLSY_CONSUMER_SECRET || !SELLSY_USER_TOKEN || !SELLSY_USER_SECRET) {
            return null;
        }

        /** @noinspection PhpUndefinedConstantInspection */
        $transport = new Guzzle(
            SELLSY_CONSUMER_TOKEN,
            SELLSY_CONSUMER_SECRET,
            SELLSY_USER_TOKEN,
            SELLSY_USER_SECRET
        );

        /** @noinspection PhpUndefinedConstantInspection */
        if (LOGGING_ENABLED) {
            // Setup initial variable
            $baseDir = realpath(dirname(__DIR__) . '/Logs');
            $mainIndexLogFile = $baseDir . '/00-Index.json';

            // Get main index content
            $indexContent = @json_decode(file_get_contents($mainIndexLogFile), true);
            $indexContent = is_array($indexContent) ? $indexContent : array();

            // Get folder path for the current session
            $sessionLogFolderIndex = sprintf("%03d", count($indexContent) + 1);
            $sessionLogFolderPath = $baseDir . '/' . $sessionLogFolderIndex;

            // Create the folder if need
            if (! is_dir($sessionLogFolderPath)) {
                mkdir($sessionLogFolderPath);
            }

            // Add entry to main index
            $indexContent[] = array(
                'folder' => $sessionLogFolderIndex,
                'date' => date(DATE_ATOM)
            );

            // Save it
            file_put_contents($mainIndexLogFile, json_encode($indexContent, JSON_PRETTY_PRINT));

            $transport->registerMiddleware(function (callable $handler) use ($sessionLogFolderPath) {
                return function (RequestInterface $request, array $options) use ($handler, $sessionLogFolderPath) {
                    // Initialize request level log variables
                    $requestDate = date(DATE_ATOM);
                    $requestMethod = 'Unknown';
                    $requestParams = 'Unknown';

                    // Extract request body information
                    $requestBody = urldecode($request->getBody());

                    if (preg_match('/\{(?:[^{}]|(?R))*\}/x', $requestBody, $matches)) {
                        if(isset($matches[0])) {
                            $requestDetails = json_decode($matches[0], true);

                            if (isset($requestDetails['method'])) {
                                $requestMethod = $requestDetails['method'];
                            }

                            if (isset($requestDetails['params'])) {
                                $requestParams = $requestDetails['params'];
                            }
                        }
                    }

                    // Get session index file path
                    $sessionIndexFilePath = $sessionLogFolderPath . '/00-Index.json';

                    // Get session index content
                    $sessionIndexContent = @json_decode(file_get_contents($sessionIndexFilePath), true);
                    $sessionIndexContent = is_array($sessionIndexContent) ? $sessionIndexContent : array();
                    
                    if (! isset($sessionIndexContent[$requestMethod])) {
                        $sessionIndexContent[$requestMethod] = array();
                    }

                    $responseLogFileName = sprintf("%s-%s.json", $requestMethod, sprintf("%03d", count($sessionIndexContent[$requestMethod]) + 1));

                    $sessionIndexContent[$requestMethod][] = array(
                        'file' => $responseLogFileName,
                        'date' => $requestDate,
                        'params' => $requestParams
                    );

                    if (file_put_contents($sessionIndexFilePath, json_encode($sessionIndexContent, JSON_PRETTY_PRINT))) {
                        /** @var Promise $promise */
                        $promise = $handler($request, $options);

                        $promise->then(function(ResponseInterface $response) use($sessionLogFolderPath, $requestParams, $responseLogFileName) {
                            file_put_contents(
                                $sessionLogFolderPath . '/' . $responseLogFileName,
                                json_encode(json_decode($response->getBody()), JSON_PRETTY_PRINT)
                            );

                            return $response;
                        });

                        return $promise;
                    }

                    return $handler($request, $options);
                };
            });
        }

        return $transport;
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
     * @return Api
     */
    public static function getApi()
    {
        if (!self::$api) {
            self::$api = new Api(self::getAdapter());
        }

        return self::$api;
    }
}