<?php

namespace Sellsy\Adapters;

use Sellsy\Exception\RuntimeException;
use Sellsy\Exception\ServerException;
use Sellsy\Mappers\BaseMapper;

/**
 * Class BaseAdapter
 * @package Sellsy\Adapters
 */
class BaseAdapter
{
    /**
     * @vra string
     */
    const API_ENDPOINT = "https://apifeed.sellsy.com/0/";

    /**
     * @var \Oauth
     */
    protected $oauthClient;

    /**
     * @var BaseMapper
     */
    protected $mapper;

    /**
     * @var object
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
        $this->oauthClient = new \Oauth($consumerToken, $consumerSecret, @PLAINTEXT, OAUTH_AUTH_TYPE_FORM);
        $this->oauthClient->setToken($userToken, $userSecret);
    }

    /**
     * @param BaseMapper $mapper
     */
    public function setMapper(BaseMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * @param $object
     * @return $this
     * @throws \Sellsy\Exception\RuntimeException
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
            $this->oauthClient->fetch(
                self::API_ENDPOINT,
                array(
                    'request' => 1,
                    'io_mode' =>  'json',
                    'do_in' => json_encode($requestSettings)
                ),
                OAUTH_HTTP_METHOD_POST
            );

            $request = json_decode($this->oauthClient->getLastResponse());

            if (is_null($request)) {
                $lastResponseInfos = $this->oauthClient->getLastResponseInfo();

                throw new ServerException(sprintf(
                    "An unexpected error occurred when contacting the Sellsy API, the response is null with HTTP Code %s",
                    $lastResponseInfos['http_code']
                ));
            }

            if ($request->status != 'success') {
                $message = $request;

                if (is_object($request)) {
                    $message = $request->error;

                    if (isset($request->more)) {
                        $message .= ' | ' . $request->more;
                    }

                    if (is_object($request->error)) {
                        $message = $request->error->message;

                        if (isset($request->error->more)) {
                            $message .= ' | ' . $request->error->more;
                        }
                    }
                }

                throw new \OAuthException($message);
            }

            $response = $request->response;

            if ($this->subject) {
                $response = $this->mapper->map($this->subject, $response);
                $this->subject = null;
            }

            return $response;
        }
        catch(\OAuthException $e) {
            throw new ServerException(
                sprintf(
                    "An error occurred during the call of Sellsy API with message '%s'. The response is %s",
                    $e->getMessage(),
                    $this->oauthClient->getLastResponse()
                ),
                $e->getCode(),
                $e
            );
        }
    }
} 