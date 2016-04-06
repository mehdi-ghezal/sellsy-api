<?php

namespace Sellsy\Api;

use Sellsy\Adapters\AdapterInterface;
use Sellsy\Collections\Collection;
use Sellsy\Criteria\EmptyCriteria;
use Sellsy\Criteria\Paginator;
use Sellsy\Models\Staff\PeopleInterface;

/**
 * Class Staffs
 *
 * @package Sellsy\Api
 */
class Staffs
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
     * @param Paginator|null $paginator
     * @return Collection
     */
    public function listAll(Paginator $paginator = null)
    {
        return $this->adapter->map(PeopleInterface::class)->call('Staffs.getList', new EmptyCriteria(), $paginator);
    }
} 