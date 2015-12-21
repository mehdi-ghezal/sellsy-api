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
     * @return mixed
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

            $apiResponse = json_decode($httpResponseBody);

            // Sometimes Sellsy send an empty response ; I suppose it append when an internal error append in Sellsy API
            if (is_null($apiResponse)) {
                throw new \Exception(sprintf(
                    "An unexpected error occurred when contacting the Sellsy API, the response is null with HTTP Code %s",
                    $httpResponseStatusCode
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