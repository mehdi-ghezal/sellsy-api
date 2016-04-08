<?php

namespace Sellsy\Adapters;

use Psr\Log\LoggerAwareTrait;
use Psr\Log\NullLogger;
use Sellsy\Collections\Collection;
use Sellsy\Criteria\Paginator;
use Sellsy\Exception\RuntimeException;
use Sellsy\Criteria\CriteriaInterface;
use Sellsy\Mappers\MapperInterface;
use Sellsy\Transports\TransportInterface;

/**
 * Class MapperAdapter
 *
 * @package Sellsy\Adapters
 */
class MapperAdapter implements AdapterInterface
{
    use LoggerAwareTrait;

    /**
     * @var TransportInterface
     */
    protected $transport;

    /**
     * @var MapperInterface
     */
    protected $mapper;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $context;

    /**
     * MapperAdapter constructor.
     *
     * @param TransportInterface $transport
     * @param MapperInterface $mapper
     */
    public function __construct(TransportInterface $transport, MapperInterface $mapper)
    {
        $this->transport = $transport;
        $this->mapper = $mapper;
        $this->logger = new NullLogger();
    }

    /**
     * @inheritdoc
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * @inheritdoc
     */
    public function map($interface, $context)
    {
        $this->subject = $interface;
        $this->context = $context;

        return $this;
    }

    /**
     * @param $method
     * @param CriteriaInterface|null $criteria
     * @param Paginator|null $paginator
     * @return mixed
     * @throws \Sellsy\Exception\RuntimeException
     * @throws \Exception
     */
    public function call($method, CriteriaInterface $criteria = null, Paginator $paginator = null)
    {
        // Ensure to clean subject, @see finally
        try {
            $parameters = array_merge(
                $criteria ? $criteria->getParameters() : array(),
                $paginator ? $paginator->getParameters() : array()
            );

            $this->logger->debug(sprintf('API Call - Method %s', $method), array(
                'parameters' => $parameters,
                'subject' => $this->subject,
                'context' => $this->context
            ));

            // Send API Call with the transport
            $apiResult = $this->transport->call(array(
                'method' => $method,
                'params' => $parameters
            ));

            $this->logger->debug(sprintf('API Result - Method %s', $method), array( 'result' => $apiResult ));

            // API Call that return only a status
            if (array_key_exists('response', $apiResult) && ! is_array($apiResult['response'])) {
                $this->subject = null;
                $this->context = null;

                return true;
            }

            // In this case, the subject and context is required for this adapter
            if (! $this->subject || !$this->context) {
                throw new RuntimeException('No interface mapped or no context defined, you must call "map" method before use the "call" method');
            }

            // API Call that return a collection
            if (isset($apiResult['response']['result'])) {
                // Update paginator from API Response
                $paginator = $paginator ?: new Paginator();

                if (isset($apiResult['response']['infos'])) {
                    $paginator->setPageNumber($apiResult['response']['infos']['pagenum']);
                    $paginator->setNumberPerPage($apiResult['response']['infos']['nbperpage']);
                    $paginator->setNumberOfPages($apiResult['response']['infos']['nbpages']);
                    $paginator->setNumberOfResults($apiResult['response']['infos']['nbtotal']);
                } else {
                    $paginator->setPageNumber(1);
                    $paginator->setNumberOfPages(1);
                    $paginator->setNumberOfResults(count($apiResult['response']['result']));
                    $paginator->setNumberPerPage($paginator->getNumberOfResults());
                }

                // Initialize items
                $items = array();

                // Map objects
                foreach($apiResult['response']['result'] as $value) {
                    $items[] = $this->mapper->mapObject($this->subject, $this->context, $value);
                }

                $result = new Collection(array(
                    'items' => $items,
                    'adapter' => $this,
                    'method' => $method,
                    'subject' => $this->subject,
                    'context' => $this->context,
                    'paginator' => $paginator,
                    'criteria' => $criteria
                ));
            }

            // API Call that return an object
            else {
                $result = $this->mapper->mapObject($this->subject, $this->context, $apiResult['response']);
            }
        }

        // Throw catched exception
        catch(\Exception $e) {
            throw $e;
        }

        // Reset subject and context for next call
        finally {
            $this->subject = null;
            $this->context = null;
        }

        return $result;
    }
}