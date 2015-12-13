<?php

namespace Sellsy\Criteria\Catalogue;

use Sellsy\Criteria\Generic\GetOneCriteria;

/**
 * Class ItemCriteria
 * @package Sellsy\Criteria\Catalogue
 */
class ItemCriteria extends GetOneCriteria
{
    /**
     * @var bool
     */
    protected $includeDeclinaisons = false;

    /**
     * @var bool
     */
    protected $includeRelatedItems = false;

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
            'id' => $this->id,
            'includeDecli' => $this->includeDeclinaisons,
            'includeAssociatedItems' => $this->includeRelatedItems
        );
    }
} 