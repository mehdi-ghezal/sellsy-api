<?php

namespace Sellsy\Clients;

use Sellsy\Criteria\Catalogue\ItemCriteria;
use Sellsy\Criteria\Catalogue\ItemsSearchCriteria;
use Sellsy\Collections\Catalogue\ItemCollection;
use Sellsy\Interfaces\AdapterInterface;
use Sellsy\Models\Catalogue\Item;

/**
 * Class Catalogue
 * @package Sellsy\Clients
 */
class Catalogue
{
    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
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

    /**
     * @param ItemsSearchCriteria $criteria
     * @return ItemCollection
     */
    public function searchItems(ItemsSearchCriteria $criteria)
    {
        return $this->adapter->map(new ItemCollection())->call(array(
            'method' => 'Catalogue.getList',
            'params' => $criteria->getParameters()
        ));
    }
} 