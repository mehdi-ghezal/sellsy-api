<?php

namespace Sellsy\Adapters;

use Sellsy\Exception\RuntimeException;
use Sellsy\Interfaces\MapperInterface;
use Sellsy\Interfaces\TransportInterface;

/**
 * Class BaseAdapter
 * @package Sellsy\Adapters
 */
class BaseAdapter
{
    /**
     * @var TransportInterface
     */
    protected $transport;

    /**
     * @var MapperInterface
     */
    protected $mapper;

    /**
     * @var mixed
     */
    protected $subject;

    /**
     * BaseAdapter constructor.
     *
     * @param TransportInterface $transport
     */
    public function __construct(TransportInterface $transport)
    {
        $this->transport = $transport;
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
     * @return mixed|object
     * @throws \Sellsy\Exception\ServerException
     */
    public function call(array $requestSettings)
    {
        $apiResult = $this->transport->call($requestSettings);

        if ($this->subject) {
            if (isset($apiResult->response->result)) {
                $apiResult = $this->mapper->mapCollection($this->subject, $apiResult->response->result);
            } else {
                $apiResult = $this->mapper->mapObject($this->subject, $apiResult->response);
            }

            $this->subject = null;
        }

        return $apiResult;
    }
}