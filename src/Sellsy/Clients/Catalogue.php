<?php

namespace Sellsy\Clients;

use Sellsy\Adapters\BaseAdapter;
use Sellsy\Clients\Catalogue\ItemCriteria;
use Sellsy\Models\Catalogue\Item;

/**
 * Class Catalogue
 * @package Sellsy\Clients
 */
class Catalogue
{
    /**
     * @var BaseAdapter
     */
    protected $adapter;

    /**
     * @param BaseAdapter $adapter
     */
    public function __construct(BaseAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param ItemCriteria $criteria
     * @return Item
     */
    public function getItem(ItemCriteria $criteria)
    {
        return $this->adapter->map(new Item())->call(array(
            'method' => 'Catalogue.getOne',
            'params' => $criteria->getParameters()
        ));
    }
} 