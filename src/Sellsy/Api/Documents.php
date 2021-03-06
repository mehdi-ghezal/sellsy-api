<?php

namespace Sellsy\Api;

use Sellsy\Collections\Collection;
use Sellsy\Criteria\Documents\GetDocumentCriteria\GetDeliveryCriteria;
use Sellsy\Criteria\Documents\GetDocumentCriteria\GetEstimateCriteria;
use Sellsy\Criteria\Documents\GetDocumentCriteria\GetInvoiceCriteria;
use Sellsy\Criteria\Documents\GetDocumentCriteria\GetOrderCriteria;
use Sellsy\Criteria\Documents\GetDocumentCriteria\GetProformaCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\SearchEstimatesCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\SearchInvoicesCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\SearchDeliveriesCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\SearchOrdersCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\SearchProformaCriteria;
use Sellsy\Criteria\Documents\UpdateStepCriteria;
use Sellsy\Criteria\Paginator;
use Sellsy\Adapters\AdapterInterface;
use Sellsy\Exception\ServerException;
use Sellsy\Models\Documents\Document\StepInterface;
use Sellsy\Models\Documents\DocumentInterface;
use Sellsy\Models\Documents\EstimateInterface;
use Sellsy\Models\Documents\InvoiceInterface;
use Sellsy\Models\Documents\DeliveryInterface;
use Sellsy\Models\Documents\ProformaInterface;
use Sellsy\Models\Documents\OrderInterface;

/**
 * Class Documents
 *
 * @package Sellsy\Api
 */
class Documents
{
    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * Documents constructor.
     *
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param string $consumerToken
     * @param string $consumerSecret
     * @param string $userToken
     * @param string $userSecret
     * @return $this
     */
    public function overrideAuthentication($consumerToken, $consumerSecret, $userToken, $userSecret)
    {
        $this->adapter->getTransport()->overrideAuthentication($consumerToken, $consumerSecret, $userToken, $userSecret);
        return $this;
    }

    /**
     * @param SearchEstimatesCriteria $criteria
     * @param Paginator|null $paginator
     * @return Collection
     */
    public function searchEstimates(SearchEstimatesCriteria $criteria, Paginator $paginator = null)
    {
        return $this->adapter->map(EstimateInterface::class, 'list')->call('Document.getList', $criteria, $paginator);
    }

    /**
     * @param SearchInvoicesCriteria $criteria
     * @param Paginator|null $paginator
     * @return Collection
     */
    public function searchInvoices(SearchInvoicesCriteria $criteria, Paginator $paginator = null)
    {
        return $this->adapter->map(InvoiceInterface::class, 'list')->call('Document.getList', $criteria, $paginator);
    }

    /**
     * @param SearchOrdersCriteria $criteria
     * @param Paginator|null $paginator
     * @return Collection
     */
    public function searchOrders(SearchOrdersCriteria $criteria, Paginator $paginator = null)
    {
        return $this->adapter->map(OrderInterface::class, 'list')->call('Document.getList', $criteria, $paginator);
    }

    /**
     * @param SearchDeliveriesCriteria $criteria
     * @param Paginator|null $paginator
     * @return Collection
     */
    public function searchDelivery(SearchDeliveriesCriteria $criteria, Paginator $paginator = null)
    {
        return $this->adapter->map(DeliveryInterface::class, 'list')->call('Document.getList', $criteria, $paginator);
    }

    /**
     * @param SearchProformaCriteria $criteria
     * @param Paginator|null $paginator
     * @return Collection
     */
    public function searchProforma(SearchProformaCriteria $criteria, Paginator $paginator = null)
    {
        return $this->adapter->map(ProformaInterface::class, 'list')->call('Document.getList', $criteria, $paginator);
    }

    /**
     * @param GetEstimateCriteria $criteria
     * @return EstimateInterface|array
     */
    public function getEstimate(GetEstimateCriteria $criteria)
    {
        return $this->adapter->map(EstimateInterface::class, 'one')->call('Document.getOne', $criteria);
    }

    /**
     * @param GetInvoiceCriteria $criteria
     * @return InvoiceInterface|array
     */
    public function getInvoice(GetInvoiceCriteria $criteria)
    {
        return $this->adapter->map(InvoiceInterface::class, 'one')->call('Document.getOne', $criteria);
    }

    /**
     * @param GetDeliveryCriteria $criteria
     * @return DeliveryInterface|array
     */
    public function getDelivery(GetDeliveryCriteria $criteria)
    {
        return $this->adapter->map(DeliveryInterface::class, 'one')->call('Document.getOne', $criteria);
    }

    /**
     * @param GetOrderCriteria $criteria
     * @return OrderInterface|array
     */
    public function getOrder(GetOrderCriteria $criteria)
    {
        return $this->adapter->map(OrderInterface::class, 'one')->call('Document.getOne', $criteria);
    }

    /**
     * @param GetProformaCriteria $criteria
     * @return ProformaInterface|array
     */
    public function getProforma(GetProformaCriteria $criteria)
    {
        return $this->adapter->map(ProformaInterface::class, 'one')->call('Document.getOne', $criteria);
    }

    /**
     * @param UpdateStepCriteria $criteria
     * @return bool
     */
    public function updateStep(UpdateStepCriteria $criteria)
    {
        try {
            $this->adapter->call('Document.updateStep', $criteria);
            return true;
        }

        catch(ServerException $e) {
            return false;
        }
    }
} 