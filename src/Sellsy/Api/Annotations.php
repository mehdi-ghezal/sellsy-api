<?php

namespace Sellsy\Api;

use Sellsy\Adapters\AdapterInterface;
use Sellsy\Collections\Collection;
use Sellsy\Criteria\Annotations\SearchAnnotationsCriteria;
use Sellsy\Criteria\Paginator;
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
     * @param SearchAnnotationsCriteria $criteria
     * @param Paginator|null $paginator
     * @return Collection
     */
    public function searchAnnotations(SearchAnnotationsCriteria $criteria, Paginator $paginator = null)
    {
        return $this->adapter->map(AnnotationInterface::class)->call('Annotations.getList', $criteria, $paginator);
    }
} 