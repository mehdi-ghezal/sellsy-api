<?php

namespace Sellsy\Clients;

use Sellsy\Collections\Collection;
use Sellsy\Criteria\Documents\SearchCriteria\EstimateSearchCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\InvoiceSearchCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\DeliverySearchCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\OrderSearchCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\ProformaSearchCriteria;
use Sellsy\Criteria\Order;
use Sellsy\Criteria\Paginator;
use Sellsy\Adapters\AdapterInterface;
use Sellsy\Models\Documents\EstimateInterface;
use Sellsy\Models\Documents\InvoiceInterface;
use Sellsy\Models\Documents\DeliveryInterface;
use Sellsy\Models\Documents\ProformaInterface;
use Sellsy\Models\Documents\OrderInterface;

/**
 * Class Documents
 * @package Sellsy\Clients
 */
class Documents
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
     * @param EstimateSearchCriteria $criteria
     * @param Order|null $order
     * @param Paginator|null $paginator
     * @return Collection
     */
    public function searchEstimates(EstimateSearchCriteria $criteria, Order $order = null, Paginator $paginator = null)
    {
        return $this->adapter->map(EstimateInterface::class)->call('Document.getList', $criteria, $order, $paginator);
    }

    /**
     * @param InvoiceSearchCriteria $criteria
     * @param Order|null $order
     * @param Paginator|null $paginator
     * @return Collection
     */
    public function searchInvoices(InvoiceSearchCriteria $criteria, Order $order = null, Paginator $paginator = null)
    {
        return $this->adapter->map(InvoiceInterface::class)->call('Document.getList', $criteria, $order, $paginator);
    }

    /**
     * @param OrderSearchCriteria $criteria
     * @param Order|null $order
     * @param Paginator|null $paginator
     * @return Collection
     */
    public function searchOrders(OrderSearchCriteria $criteria, Order $order = null, Paginator $paginator = null)
    {
        return $this->adapter->map(OrderInterface::class)->call('Document.getList', $criteria, $order, $paginator);
    }

    /**
     * @param DeliverySearchCriteria $criteria
     * @param Order|null $order
     * @param Paginator|null $paginator
     * @return Collection
     */
    public function searchDelivery(DeliverySearchCriteria $criteria, Order $order = null, Paginator $paginator = null)
    {
        return $this->adapter->map(DeliveryInterface::class)->call('Document.getList', $criteria, $order, $paginator);
    }

    /**
     * @param ProformaSearchCriteria $criteria
     * @param Order|null $order
     * @param Paginator|null $paginator
     * @return Collection
     */
    public function searchProforma(ProformaSearchCriteria $criteria, Order $order = null, Paginator $paginator = null)
    {
        return $this->adapter->map(ProformaInterface::class)->call('Document.getList', $criteria, $order, $paginator);
    }
} 