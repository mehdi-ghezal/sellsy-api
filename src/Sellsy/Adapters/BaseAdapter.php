<?php

namespace Sellsy\Adapters;

use Sellsy\Interfaces\AdapterInterface;
use Sellsy\Interfaces\TransportInterface;

/**
 * Class BaseAdapter
 * @package Sellsy\Adapters
 */
class BaseAdapter implements AdapterInterface
{
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
    }

    /**
     * @param mixed $object
     * @return $this
     */
    public function map($object)
    {
        return $this;
    }

    /**
     * @param array $requestSettings
     * @return array
     * @throws \Sellsy\Exception\ServerException
     */
    public function call(array $requestSettings)
    {
        return $this->transport->call($requestSettings);
    }
}