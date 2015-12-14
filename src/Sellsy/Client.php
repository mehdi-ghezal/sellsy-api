<?php

namespace Sellsy;

use Sellsy\Clients\Catalogue;
use Sellsy\Clients\Documents;
use Sellsy\Interfaces\AdapterInterface;
use Sellsy\Models\ApiInfos;

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
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @return mixed
     */
    public function getApiInfos()
    {
        return $this->adapter->map(new ApiInfos())->call('Infos.getInfos');
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