<?php

namespace Sellsy\Clients;

use Sellsy\Collections\Collection;
use Sellsy\Criteria\Catalogue\ItemCriteria;
use Sellsy\Criteria\Catalogue\ItemsSearchCriteria;
use Sellsy\Criteria\Order;
use Sellsy\Criteria\Paginator;
use Sellsy\Adapters\AdapterInterface;
use Sellsy\Models\Catalogue\ItemInterface;

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
     * @return ItemInterface
     */
    public function getItem(ItemCriteria $criteria)
    {
        return $this->adapter->map(ItemInterface::class)->call('Catalogue.getOne', $criteria);
    }

    /**
     * @param ItemsSearchCriteria $criteria
     * @param Order|null $order
     * @param Paginator|null $paginator
     * @return Collection
     */
    public function searchItems(ItemsSearchCriteria $criteria, Order $order = null, Paginator $paginator = null)
    {
        return $this->adapter->map(ItemInterface::class)->call('Catalogue.getList', $criteria, $order, $paginator);
    }
} 