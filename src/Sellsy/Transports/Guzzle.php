<?php

namespace Sellsy\Transports;

use GuzzleHttp\Client;
use Sellsy\Interfaces\TransportInterface;

/**
 * Class Guzzle
 * @package Sellsy\Transports
 */
class Guzzle extends AbstractTransport
{
    /**
     * @var string
     */
    protected $oauthConsumerKey;

    /**
     * @var string
     */
    protected $oauthSignature;

    /**
     * @var string
     */
    protected $oauthToken;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @param string $consumerToken
     * @param string $consumerSecret
     * @param string $userToken
     * @param string $userSecret
     */
    public function __construct($consumerToken, $consumerSecret, $userToken, $userSecret)
    {
        $this->oauthConsumerKey = rawurlencode($consumerToken);
        $this->oauthToken = rawurlencode($userToken);
        $this->oauthSignature = rawurlencode(rawurlencode($consumerSecret).'&'.rawurlencode($userSecret));

        $this->client = new Client();
    }

    /**
     * @param callable $middleware
     * @return $this
     */
    public function registerMiddleware(callable $middleware)
    {
        $this->client->getConfig('handler')->push($middleware);
        return $this;
    }

    /**
     * @param array $requestSettings
     * @return array
     * @throws \Sellsy\Exception\ServerException
     */
    public function call(array $requestSettings)
    {
        $response = $this->client->post(TransportInterface::API_ENDPOINT, array(
            'headers' => array(
                'Authorization' => sprintf(
                    "OAuth %s, %s, %s, %s, %s, %s, %s",
                    sprintf('oauth_consumer_key="%s"',      $this->oauthConsumerKey),
                    sprintf('oauth_token="%s"',             $this->oauthToken),
                    sprintf('oauth_nonce="%s"',             md5(time() + rand(0,1000))),
                    sprintf('oauth_timestamp="%s"',         time()),
                    sprintf('oauth_signature_method="%s"',  'PLAINTEXT'),
                    sprintf('oauth_signature="%s"',         $this->oauthSignature),
                    sprintf('oauth_version="%s"',           '1.0')
                )
            ),
            'form_params' => array(
                'request' => 1,
                'io_mode' => 'json',
                'do_in' => json_encode($requestSettings),
            )
        ));

        return $this->convertResponseBody($response->getBody(), $response->getStatusCode());
    }
}