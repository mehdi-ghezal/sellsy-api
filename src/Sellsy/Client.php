<?php

namespace Sellsy;

use Sellsy\Clients\Catalogue;
use Sellsy\Clients\Documents;
use Sellsy\Adapters\AdapterInterface;
use Sellsy\Models\ApiInfosInterface;

/**
 * Class Client
 * @package Sellsy
 */
class Client
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
     * @return Documents
     */
    public function documents()
    {
        if (! isset($clients['documents'])) {
            $clients['documents'] = new Documents($this->adapter);
        }

        return $clients['documents'];
    }
}