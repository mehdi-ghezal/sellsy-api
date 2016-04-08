<?php

namespace Sellsy\Adapters;

use Psr\Log\LoggerAwareTrait;
use Psr\Log\NullLogger;
use Sellsy\Collections\Collection;
use Sellsy\Criteria\Paginator;
use Sellsy\Criteria\CriteriaInterface;
use Sellsy\Transports\TransportInterface;

/**
 * Class BaseAdapter
 *
 * @package Sellsy\Adapters
 */
class BaseAdapter implements AdapterInterface
{
    use LoggerAwareTrait;

    /**
     * @var TransportInterface
     */
    protected $transport;

    /**
     * BaseAdapter constructor.
     *
     * @param TransportInterface $transport
     */
    public function __construct(TransportInterface $transport)
    {
        $this->transport = $transport;
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
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function call($method, CriteriaInterface $criteria = null, Paginator $paginator = null)
    {
        $parameters = array_merge(
            $criteria ? $criteria->getParameters() : array(),
            $paginator ? $paginator->getParameters() : array()
        );

        $this->logger->debug(sprintf('API Call - Method %s', $method), array( 'parameters' => $parameters ));

        $result = $this->transport->call(array(
            'method' => $method,
            'params' => $parameters
        ));

        $this->logger->debug(sprintf('API Result - Method %s', $method), array( 'result' => $result ));


        // API Call that return a collection
        if (isset($result['response']['result'])) {
            // Update paginator from API Response
            $paginator = $paginator ?: new Paginator();
            $paginator->setPageNumber($result['response']['infos']['pagenum']);
            $paginator->setNumberPerPage($result['response']['infos']['nbperpage']);
            $paginator->setNumberOfPages($result['response']['infos']['nbpages']);
            $paginator->setNumberOfResults($result['response']['infos']['nbtotal']);

            // Initialize items
            $items = array();

            // Map objects
            foreach($result['response']['result'] as $value) {
                $items[] = $value;
            }

            $result = new Collection(array(
                'items' => $items,
                'adapter' => $this,
                'method' => $method,
                'paginator' => $paginator,
                'criteria' => $criteria
            ));
        }

        return $result;
    }
}