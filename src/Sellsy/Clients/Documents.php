<?php

namespace Sellsy\Clients;

use Sellsy\Collections\Documents\DeliveryCollection;
use Sellsy\Collections\Documents\EstimateCollection;
use Sellsy\Collections\Documents\InvoiceCollection;
use Sellsy\Collections\Documents\OrderCollection;
use Sellsy\Collections\Documents\ProformaCollection;
use Sellsy\Criteria\Documents\SearchCriteria\EstimateSearchCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\InvoiceSearchCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\DeliverySearchCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\OrderSearchCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\ProformaSearchCriteria;
use Sellsy\Criteria\Order;
use Sellsy\Criteria\Paginator;
use Sellsy\Interfaces\AdapterInterface;

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
     * @return EstimateCollection
     */
    public function searchEstimates(EstimateSearchCriteria $criteria, Order $order = null, Paginator $paginator = null)
    {
        return $this->adapter->map(new EstimateCollection())->call('Document.getList', $criteria, $order, $paginator);
    }

    /**
     * @param InvoiceSearchCriteria $criteria
     * @param Order|null $order
     * @param Paginator|null $paginator
     * @return InvoiceCollection
     */
    public function searchInvoices(InvoiceSearchCriteria $criteria, Order $order = null, Paginator $paginator = null)
    {
        return $this->adapter->map(new InvoiceCollection())->call('Document.getList', $criteria, $order, $paginator);
    }

    /**
     * @param OrderSearchCriteria $criteria
     * @param Order|null $order
     * @param Paginator|null $paginator
     * @return OrderCollection
     */
    public function searchOrders(OrderSearchCriteria $criteria, Order $order = null, Paginator $paginator = null)
    {
        return $this->adapter->map(new OrderCollection())->call('Document.getList', $criteria, $order, $paginator);
    }

    /**
     * @param DeliverySearchCriteria $criteria
     * @param Order|null $order
     * @param Paginator|null $paginator
     * @return DeliveryCollection
     */
    public function searchDelivery(DeliverySearchCriteria $criteria, Order $order = null, Paginator $paginator = null)
    {
        return $this->adapter->map(new DeliveryCollection())->call('Document.getList', $criteria, $order, $paginator);
    }

    /**
     * @param ProformaSearchCriteria $criteria
     * @param Order|null $order
     * @param Paginator|null $paginator
     * @return ProformaCollection
     */
    public function searchProforma(ProformaSearchCriteria $criteria, Order $order = null, Paginator $paginator = null)
    {
        return $this->adapter->map(new ProformaCollection())->call('Document.getList', $criteria, $order, $paginator);
    }
} 