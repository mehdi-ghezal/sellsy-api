<?php

namespace Sellsy\Transports;

use Sellsy\Exception\ServerException;
use Sellsy\Interfaces\TransportInterface;

/**
 * Class AbstractTransport
 * @package Sellsy\Transports
 */
abstract class AbstractTransport implements TransportInterface
{
    /**
     * @param string $httpResponseBody
     * @param int $httpResponseStatusCode
     * @return array
     * @throws ServerException
     */
    public function convertResponseBody($httpResponseBody, $httpResponseStatusCode)
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