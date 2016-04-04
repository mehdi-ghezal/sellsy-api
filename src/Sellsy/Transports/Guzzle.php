<?php

namespace Sellsy\Transports;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Sellsy\Exception\ServerException;

/**
 * Class Guzzle
 * @package Sellsy\Transports
 */
class Guzzle extends AbstractTransport
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @param Client $guzzleClient
     * @param string $consumerToken
     * @param string $consumerSecret
     * @param string $userToken
     * @param string $userSecret
     */
    public function __construct(Client $guzzleClient, $consumerToken, $consumerSecret, $userToken, $userSecret)
    {
        $this->client = $guzzleClient;

        $this->consumerToken = $consumerToken;
        $this->consumerSecret = $consumerSecret;
        $this->userToken = $userToken;
        $this->userSecret = $userSecret;
    }

    /**
     * @param array $requestSettings
     * @return array
     * @throws \Sellsy\Exception\ServerException
     */
    public function call(array $requestSettings)
    {
        try {
            $response = $this->client->post(TransportInterface::API_ENDPOINT, array(
                'headers' => array(
                    'Authorization' => $this->getAuthenticationHeader()
                ),
                'form_params' => array(
                    'request' => 1,
                    'io_mode' => 'json',
                    'do_in' => json_encode($requestSettings),
                )
            ));
        }
        catch (GuzzleException $e) {
            throw new ServerException($e->getMessage(), $e->getCode(), $e);
        }

        return $this->convertResponseBody($response->getBody(), $response->getStatusCode());
    }
}