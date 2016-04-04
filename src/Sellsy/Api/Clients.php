<?php

namespace Sellsy\Api;

use Sellsy\Collections\Collection;
use Sellsy\Criteria\Client\SearchCustomersCriteria;
use Sellsy\Criteria\Paginator;
use Sellsy\Adapters\AdapterInterface;
use Sellsy\Models\Client\CustomerInterface;

/**
 * Class Clients
 *
 * @package Sellsy\Api
 */
class Clients
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
     * @param SearchCustomersCriteria $criteria
     * @param Paginator|null $paginator
     * @return Collection
     */
    public function searchCustomers(SearchCustomersCriteria $criteria, Paginator $paginator = null)
    {
        return $this->adapter->map(CustomerInterface::class)->call('Client.getList', $criteria, $paginator);
    }
} 