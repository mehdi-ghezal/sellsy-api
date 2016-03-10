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
     * @param Client $guzzleClient
     * @param string $consumerToken
     * @param string $consumerSecret
     * @param string $userToken
     * @param string $userSecret
     */
    public function __construct(Client $guzzleClient, $consumerToken, $consumerSecret, $userToken, $userSecret)
    {
        $this->client = $guzzleClient;

        $this->oauthConsumerKey = rawurlencode($consumerToken);
        $this->oauthToken = rawurlencode($userToken);
        $this->oauthSignature = rawurlencode(rawurlencode($consumerSecret).'&'.rawurlencode($userSecret));
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
        }
        catch (GuzzleException $e) {
            throw new ServerException($e->getMessage(), $e->getCode(), $e);
        }

        return $this->convertResponseBody($response->getBody(), $response->getStatusCode());
    }
}