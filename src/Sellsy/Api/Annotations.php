<?php

namespace Sellsy\Api;

use Sellsy\Adapters\AdapterInterface;
use Sellsy\Collections\Collection;
use Sellsy\Criteria\Annotations\CreateAnnotationCriteria;
use Sellsy\Criteria\Annotations\SearchAnnotationsCriteria;
use Sellsy\Criteria\Paginator;
use Sellsy\Exception\ServerException;
use Sellsy\Models\Annotations\AnnotationInterface;

/**
 * Class Annotations
 *
 * @package Sellsy\Api
 */
class Annotations
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
     * @param SearchAnnotationsCriteria $criteria
     * @param Paginator|null $paginator
     * @return Collection
     */
    public function searchAnnotations(SearchAnnotationsCriteria $criteria, Paginator $paginator = null)
    {
        return $this->adapter->map(AnnotationInterface::class)->call('Annotations.getList', $criteria, $paginator);
    }

    /**
     * @param CreateAnnotationCriteria $criteria
     * @return bool
     */
    public function create(CreateAnnotationCriteria $criteria)
    {
        try {
            $this->adapter->call('Annotations.create', $criteria);
            return true;
        }

        catch(ServerException $e) {
            return false;
        }
    }
} 