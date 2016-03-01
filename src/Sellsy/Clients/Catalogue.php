<?php

namespace Sellsy\Clients;

use Sellsy\Collections\Collection;
use Sellsy\Criteria\Catalogue\GetItemCriteria;
use Sellsy\Criteria\Catalogue\SearchItemsCriteria;
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
     * @param GetItemCriteria $criteria
     * @return ItemInterface|array
     */
    public function getItem(GetItemCriteria $criteria)
    {
        return $this->adapter->map(ItemInterface::class)->call('Catalogue.getOne', $criteria);
    }

    /**
     * @param SearchItemsCriteria $criteria
     * @param Order|null $order
     * @param Paginator|null $paginator
     * @return Collection
     */
    public function searchItems(SearchItemsCriteria $criteria, Order $order = null, Paginator $paginator = null)
    {
        return $this->adapter->map(ItemInterface::class)->call('Catalogue.getList', $criteria, $order, $paginator);
    }
} 