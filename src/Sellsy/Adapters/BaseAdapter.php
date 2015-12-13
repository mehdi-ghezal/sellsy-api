<?php

namespace Sellsy\Adapters;

use Httpful\Mime;
use Httpful\Request;
use Httpful\Response;
use Sellsy\Exception\RuntimeException;
use Sellsy\Exception\ServerException;
use Sellsy\Interfaces\MapperInterface;

/**
 * Class BaseAdapter
 * @package Sellsy\Adapters
 */
class BaseAdapter
{
    /**
     * @var string
     */
    const API_ENDPOINT = "https://apifeed.sellsy.com/0/";

    /**
     * @var MapperInterface
     */
    protected $mapper;

    /**
     * @var mixed
     */
    protected $subject;

    /**
     * @param string $consumerToken
     * @param string $consumerSecret
     * @param string $userToken
     * @param string $userSecret
     */
    public function __construct($consumerToken, $consumerSecret, $userToken, $userSecret)
    {
        $encodedKey = rawurlencode($consumerSecret).'&'.rawurlencode($userSecret);

        $oauthHeader = sprintf(
            "OAuth %s, %s, %s, %s, %s, %s, %s",
            sprintf('oauth_consumer_key="%s"',      rawurlencode($consumerToken)),
            sprintf('oauth_token="%s"',             rawurlencode($userToken)),
            sprintf('oauth_nonce="%s"',             md5(time() + rand(0,1000))),
            sprintf('oauth_timestamp="%s"',         time()),
            sprintf('oauth_signature_method="%s"',  'PLAINTEXT'),
            sprintf('oauth_signature="%s"',         rawurlencode($encodedKey)),
            sprintf('oauth_version="%s"',           '1.0')
        );

        $template = Request::init()
            ->contentType(Mime::FORM)
            ->addHeader('Authorization', $oauthHeader);

        Request::ini($template);
    }

    /**
     * @param MapperInterface $mapper
     */
    public function setMapper(MapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * @param mixed $object
     * @return $this
     * @throws RuntimeException
     */
    public function map($object)
    {
        if (! $this->mapper) {
            throw new RuntimeException("Map an object is available only if you bind a mapper with the setMapper method");
        }

        $this->subject = $object;

        return $this;
    }

    /**
     * @param array $requestSettings
     * @return mixed
     * @throws \Sellsy\Exception\ServerException
     */
    public function call(array $requestSettings)
    {
        try {
            /** @var Response $httpResponse */
            $httpResponse = Request::post(self::API_ENDPOINT)
                ->body(array(
                    'request' => 1,
                    'io_mode' => 'json',
                    'do_in' => json_encode($requestSettings),
                ))
                ->send();

            //OAuth issue : Invalid signature
            if (false !== strpos($httpResponse->body, 'oauth_problem=signature_invalid')) {
                throw new \Exception("The oauth signature is invalid, please verify the authentication credentials provided");
            }

            //OAuth issue : Consummer refused
            if (false !== strpos($httpResponse->body, 'oauth_problem=consumer_key_refused)')) {
                throw new \Exception("The consummer key has been refused, please verify it still valid");
            }

            $apiResponse = json_decode($httpResponse->body);

            // Sometimes Sellsy send an empty response ; I suppose it append when an internal error append in Sellsy API
            if (is_null($apiResponse)) {
                throw new \Exception(sprintf(
                    "An unexpected error occurred when contacting the Sellsy API, the response is null with HTTP Code %s",
                    $httpResponse->code
                ));
            }

            if ($apiResponse->status != 'success') {
                $message = $apiResponse;

                if (is_object($apiResponse)) {
                    $message = $apiResponse->error;

                    if (isset($apiResponse->more)) {
                        $message .= ' | ' . $apiResponse->more;
                    }

                    if (is_object($apiResponse->error)) {
                        $message = $apiResponse->error->message;

                        if (isset($apiResponse->error->more)) {
                            $message .= ' | ' . $apiResponse->error->more;
                        }
                    }
                }

                throw new \Exception($message);
            }

            $apiResult = $apiResponse->response;

            if ($this->subject) {
                if (isset($apiResult->result)) {
                    $apiResult = $this->mapper->mapCollection($this->subject, $apiResult->result);
                } else {
                    $apiResult = $this->mapper->mapObject($this->subject, $apiResult);
                }

                $this->subject = null;
            }

            return $apiResult;
        }
        catch(\Exception $e) {
            throw new ServerException(
                sprintf(
                    'An error occurred during the call of Sellsy API with message "%s". The response is "%s".',
                    $e->getMessage(),
                    isset($httpResponse) ? $httpResponse->raw_body : ""
                ),
                $e->getCode(),
                $e
            );
        }
    }
}