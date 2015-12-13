<?php

namespace Sellsy\Adapters;

use Sellsy\Interfaces\AdapterInterface;
use Sellsy\Interfaces\MapperInterface;
use Sellsy\Interfaces\TransportInterface;

/**
 * Class MapperAdapter
 * @package Sellsy\Adapters
 */
class MapperAdapter implements AdapterInterface
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
     * MapperAdapter constructor.
     *
     * @param TransportInterface $transport
     * @param MapperInterface $mapper
     */
    public function __construct(TransportInterface $transport, MapperInterface $mapper)
    {
        $this->transport = $transport;
        $this->mapper = $mapper;
    }

    /**
     * @param mixed $object
     * @return $this
     */
    public function map($object)
    {
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