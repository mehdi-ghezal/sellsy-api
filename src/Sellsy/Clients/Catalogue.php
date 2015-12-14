<?php

namespace Sellsy\Clients;

use Sellsy\Criteria\Catalogue\ItemCriteria;
use Sellsy\Criteria\Catalogue\ItemsSearchCriteria;
use Sellsy\Collections\Catalogue\ItemCollection;
use Sellsy\Criteria\Order;
use Sellsy\Criteria\Paginator;
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
        return $this->adapter->map(new Item())->call('Catalogue.getOne', $criteria);
    }

    /**
     * @param ItemsSearchCriteria $criteria
     * @param Order|null $order
     * @param Paginator|null $paginator
     * @return mixed
     */
    public function searchItems(ItemsSearchCriteria $criteria, Order $order = null, Paginator $paginator = null)
    {
        return $this->adapter->map(new ItemCollection())->call('Catalogue.getList', $criteria, $order, $paginator);
    }
} 