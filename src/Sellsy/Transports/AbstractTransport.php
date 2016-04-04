<?php

namespace Sellsy\Transports;

use Sellsy\Exception\ServerException;

/**
 * Class AbstractTransport
 * @package Sellsy\Transports
 */
abstract class AbstractTransport implements TransportInterface
{
    /**
     * @var string
     */
    protected $consumerToken;

    /**
     * @var string
     */
    protected $consumerSecret;

    /**
     * @var string
     */
    protected $userToken;

    /**
     * @var string
     */
    protected $userSecret;

    /**
     * @var array
     */
    private $overrideAuthentication;

    /**
     * @param string $consumerToken
     * @param string $consumerSecret
     * @param string $userToken
     * @param string $userSecret
     * @return $this
     */
    public function overrideAuthentication($consumerToken, $consumerSecret, $userToken, $userSecret)
    {
        $this->overrideAuthentication = array();
        $this->overrideAuthentication['consumerToken'] = $consumerToken;
        $this->overrideAuthentication['consumerSecret'] = $consumerSecret;
        $this->overrideAuthentication['userToken'] = $userToken;
        $this->overrideAuthentication['userSecret'] = $userSecret;

        return $this;
    }

    /**
     * @return string
     */
    protected function getAuthenticationHeader()
    {
        if ($this->overrideAuthentication) {
            $consumerToken = $this->overrideAuthentication['consumerToken'];
            $consumerSecret = $this->overrideAuthentication['consumerSecret'];
            $userToken = $this->overrideAuthentication['userToken'];
            $userSecret = $this->overrideAuthentication['userSecret'];

            $this->overrideAuthentication = array();
        } else {
            $consumerToken = $this->consumerToken;
            $consumerSecret = $this->consumerSecret;
            $userToken = $this->userToken;
            $userSecret = $this->userSecret;
        }

        return sprintf(
            "OAuth %s, %s, %s, %s, %s, %s, %s",
            sprintf('oauth_consumer_key="%s"',      rawurlencode($consumerToken)),
            sprintf('oauth_token="%s"',             rawurlencode($userToken)),
            sprintf('oauth_nonce="%s"',             md5(time() + rand(0,1000))),
            sprintf('oauth_timestamp="%s"',         time()),
            sprintf('oauth_signature_method="%s"',  'PLAINTEXT'),
            sprintf('oauth_signature="%s"',         rawurlencode(rawurlencode($consumerSecret).'&'.rawurlencode($userSecret))),
            sprintf('oauth_version="%s"',           '1.0')
        );
    }

    /**
     * @param string $httpResponseBody
     * @param int $httpResponseStatusCode
     * @return array
     * @throws ServerException
     */
    protected function convertResponseBody($httpResponseBody, $httpResponseStatusCode)
    {
        try {
            if (false !== strpos($httpResponseBody, 'oauth_problem=signature_invalid')) {
                throw new \Exception("The oauth signature is invalid, please verify the authentication credentials provided");
            }

            //OAuth issue : Consummer refused
            if (false !== strpos($httpResponseBody, 'oauth_problem=consumer_key_refused)')) {
                throw new \Exception("The consummer key has been refused, please verify it still valid");
            }

            $apiResponse = json_decode($httpResponseBody, true);

            // Sometimes Sellsy send an empty response ; I suppose it append when an internal error append in Sellsy API
            if (is_null($apiResponse)) {
                throw new \Exception(sprintf(
                    "An unexpected error occurred when contacting the Sellsy API, the response is null with HTTP Code %s",
                    $httpResponseStatusCode
                ));
            }

            if ($apiResponse['status'] != 'success') {
                $message = 'No message';

                if (isset($apiResponse['error']['message'])) {
                    $message = $apiResponse['error']['message'];

                    if (isset($apiResponse['error']['code'])) {
                        $message = sprintf('%s (%s)', $message, $apiResponse['error']['code']);
                    }

                    if (isset($apiResponse['error']['more'])) {
                        $message = sprintf('%s, %s', $message, $apiResponse['error']['more']);
                    }
                }

                // Sometimes, $apiResponse['error'] is a string in Sellsy response
                elseif (isset($apiResponse['error']) && is_string($apiResponse['error'])) {
                    $message = $apiResponse['error'];
                }

                throw new \Exception($message);
            }

            return $apiResponse;
        }
        catch(\Exception $e) {
            throw new ServerException(
                sprintf(
                    'An error occurred during the call of Sellsy API with message "%s". The response is "%s".',
                    $e->getMessage(),
                    $httpResponseBody
                ),
                $e->getCode(),
                $e
            );
        }
    }
}