<?php

namespace Sellsy\Api;

use Sellsy\Collections\Collection;
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
        return $this->adapter->map(EstimateInterface::class)->call('Document.getList', $criteria, $paginator);
    }

    /**
     * @param SearchInvoicesCriteria $criteria
     * @param Paginator|null $paginator
     * @return Collection
     */
    public function searchInvoices(SearchInvoicesCriteria $criteria, Paginator $paginator = null)
    {
        return $this->adapter->map(InvoiceInterface::class)->call('Document.getList', $criteria, $paginator);
    }

    /**
     * @param SearchOrdersCriteria $criteria
     * @param Paginator|null $paginator
     * @return Collection
     */
    public function searchOrders(SearchOrdersCriteria $criteria, Paginator $paginator = null)
    {
        return $this->adapter->map(OrderInterface::class)->call('Document.getList', $criteria, $paginator);
    }

    /**
     * @param SearchDeliveriesCriteria $criteria
     * @param Paginator|null $paginator
     * @return Collection
     */
    public function searchDelivery(SearchDeliveriesCriteria $criteria, Paginator $paginator = null)
    {
        return $this->adapter->map(DeliveryInterface::class)->call('Document.getList', $criteria, $paginator);
    }

    /**
     * @param SearchProformaCriteria $criteria
     * @param Paginator|null $paginator
     * @return Collection
     */
    public function searchProforma(SearchProformaCriteria $criteria, Paginator $paginator = null)
    {
        return $this->adapter->map(ProformaInterface::class)->call('Document.getList', $criteria, $paginator);
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