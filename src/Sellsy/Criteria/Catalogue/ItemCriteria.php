<?php

namespace Sellsy\Criteria\Catalogue;

use Sellsy\Interfaces\CriteriaInterface;

/**
 * Class ItemCriteria
 * @package Sellsy\Criteria\Catalogue
 */
class ItemCriteria implements CriteriaInterface
{
    /**
     * @var int
     */
    protected $itemIdentifier;

    /**
     * @var bool
     */
    protected $includeDeclinaisons = false;

    /**
     * @var bool
     */
    protected $includeRelatedItems = false;

    /**
     * @param int $itemIdentifier
     */
    public function __construct($itemIdentifier)
    {
        $this->itemIdentifier = $itemIdentifier;
    }

    /**
     * @param int $itemIdentifier
     */
    public function setItemIdentifier($itemIdentifier)
    {
        $this->itemIdentifier = $itemIdentifier;
    }

    /**
     * @return int
     */
    public function getItemIdentifier()
    {
        return $this->itemIdentifier;
    }

    /**
     * @param boolean $includeDeclinaisons
     */
    public function setIncludeDeclinaisons($includeDeclinaisons)
    {
        $this->includeDeclinaisons = !! $includeDeclinaisons;
    }

    /**
     * @return boolean
     */
    public function isIncludeDeclinaisons()
    {
        return $this->includeDeclinaisons;
    }

    /**
     * @param boolean $includeRelatedItems
     */
    public function setIncludeRelatedItems($includeRelatedItems)
    {
        $this->includeRelatedItems = !! $includeRelatedItems;
    }

    /**
     * @return boolean
     */
    public function isIncludeRelatedItems()
    {
        return $this->includeRelatedItems;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return array(
            'type' => 'item',
            'id' => $this->itemIdentifier,
            'includeDecli' => $this->includeDeclinaisons,
            'includeAssociatedItems' => $this->includeRelatedItems
        );
    }
} 