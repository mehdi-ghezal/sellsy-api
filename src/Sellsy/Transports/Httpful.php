<?php

namespace Sellsy\Transports;

use Httpful\Mime;
use Httpful\Request;
use Httpful\Response;
use Sellsy\Interfaces\TransportInterface;

/**
 * Class Httpful
 * @package Sellsy\Transports
 */
class Httpful extends AbstractTransport
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
    }

    /**
     * @param array $requestSettings
     * @return mixed
     * @throws \Sellsy\Exception\ServerException
     */
    public function call(array $requestSettings)
    {
        /** @var Response $httpResponse */
        $httpResponse = Request::post(TransportInterface::API_ENDPOINT)
            ->addHeader('Authorization', sprintf(
                "OAuth %s, %s, %s, %s, %s, %s, %s",
                sprintf('oauth_consumer_key="%s"',      $this->oauthConsumerKey),
                sprintf('oauth_token="%s"',             $this->oauthToken),
                sprintf('oauth_nonce="%s"',             md5(time() + rand(0,1000))),
                sprintf('oauth_timestamp="%s"',         time()),
                sprintf('oauth_signature_method="%s"',  'PLAINTEXT'),
                sprintf('oauth_signature="%s"',         $this->oauthSignature),
                sprintf('oauth_version="%s"',           '1.0')
            ))
            ->contentType(Mime::FORM)
            ->body(array(
                'request' => 1,
                'io_mode' => 'json',
                'do_in' => json_encode($requestSettings),
            ))
            ->send();

        return $this->convertResponseBody($httpResponse->body, $httpResponse->code);
    }
}