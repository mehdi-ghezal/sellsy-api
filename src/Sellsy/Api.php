<?php

namespace Sellsy;

use Sellsy\Api\Annotations;
use Sellsy\Api\Catalogue;
use Sellsy\Api\Clients;
use Sellsy\Api\Documents;
use Sellsy\Adapters\AdapterInterface;
use Sellsy\Models\ApiInfosInterface;

/**
 * Class Api
 *
 * @package Sellsy
 */
class Api
{
    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @var array
     */
    protected $clients = array();

    /**
     * Client constructor.
     *
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @return ApiInfosInterface
     */
    public function getApiInfos()
    {
        return $this->adapter->map(ApiInfosInterface::class)->call('Infos.getInfos');
    }

    /**
     * @return Catalogue
     */
    public function catalogue()
    {
        if (! isset($clients['catalogue'])) {
            $clients['catalogue'] = new Catalogue($this->adapter);
        }

        return $clients['catalogue'];
    }

    /**
     * @return Clients
     */
    public function clients()
    {
        if (! isset($clients['clients'])) {
            $clients['clients'] = new Clients($this->adapter);
        }

        return $clients['clients'];
    }

    /**
     * @return Documents
     */
    public function documents()
    {
        if (! isset($clients['documents'])) {
            $clients['documents'] = new Documents($this->adapter);
        }

        return $clients['documents'];
    }

    /**
     * @return Annotations
     */
    public function annotations()
    {
        if (! isset($clients['annotations'])) {
            $clients['annotations'] = new Annotations($this->adapter);
        }

        return $clients['annotations'];
    }
}