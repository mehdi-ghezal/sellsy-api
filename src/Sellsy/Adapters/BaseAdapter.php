<?php

namespace Sellsy\Adapters;

use Httpful\Mime;
use Httpful\Request;
use Httpful\Response;
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
     * @var string
     */
    const API_ENDPOINT = "https://apifeed.sellsy.com/0/";

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
            /** @var Response $response */
            $response = Request::post(self::API_ENDPOINT)
                ->body(array(
                    'request' => 1,
                    'io_mode' => 'json',
                    'do_in' => json_encode($requestSettings),
                ))
                ->send();

            //OAuth issue : Invalid signature
            if (false !== strpos($response->body, 'oauth_problem=signature_invalid')) {
                throw new \Exception("The oauth signature is invalid, please verify the authentication credentials provided");
            }

            //OAuth issue : Consummer refused
            if (false !== strpos($response->body, 'oauth_problem=consumer_key_refused)')) {
                throw new \Exception("The consummer key has been refused, please verify it still valid");
            }

            $request = json_decode($response->body);

            // Sometimes Sellsy send an empty response ; I suppose it append when an internal error append in Sellsy API
            if (is_null($request)) {
                throw new \Exception(sprintf(
                    "An unexpected error occurred when contacting the Sellsy API, the response is null with HTTP Code %s",
                    $response->code
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

                throw new \Exception($message);
            }

            $response = $request->response;

            if ($this->subject) {
                $response = $this->mapper->map($this->subject, $response);
                $this->subject = null;
            }

            return $response;
        }
        catch(\Exception $e) {
            throw new ServerException(
                sprintf(
                    'An error occurred during the call of Sellsy API with message "%s". The response is "%s".',
                    $e->getMessage(),
                    $response->raw_body
                ),
                $e->getCode(),
                $e
            );
        }
    }
}