<?php

namespace Sellsy\Transports;

use Httpful\Mime;
use Httpful\Request;
use Httpful\Response;
use Httpful\Exception;
use Sellsy\Exception\ServerException;

/**
 * Class Httpful
 * @package Sellsy\Transports
 */
class Httpful extends AbstractTransport
{
    /**
     * @param string $consumerToken
     * @param string $consumerSecret
     * @param string $userToken
     * @param string $userSecret
     */
    public function __construct($consumerToken, $consumerSecret, $userToken, $userSecret)
    {
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
            /** @var Response $httpResponse */
            $httpResponse = Request::post(TransportInterface::API_ENDPOINT)
                ->addHeader('Authorization', $this->getAuthenticationHeader())
                ->contentType(Mime::FORM)
                ->body(array(
                    'request' => 1,
                    'io_mode' => 'json',
                    'do_in' => json_encode($requestSettings),
                ))
                ->send();
        } catch(Exception\ConnectionErrorException $e) {
            throw new ServerException($e->getMessage(), $e->getCode(), $e);
        }

        return $this->convertResponseBody($httpResponse->raw_body, $httpResponse->code);
    }
}