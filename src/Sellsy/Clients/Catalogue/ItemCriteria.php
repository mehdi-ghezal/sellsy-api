<?php

namespace Sellsy\Clients\Catalogue;

use Sellsy\Interfaces\CriteriaInterface;

/**
 * Class ItemCriteria
 * @package Sellsy\Clients\Catalogue
 */
class ItemCriteria implements CriteriaInterface
{
    /**
     * @var int
     */
    public $itemIdentifier;

    /**
     * @var bool
     */
    public $includeDeclinaisons;

    /**
     * @var bool
     */
    public $includeRelatedItems;

    /**
     * @param int $itemIdentifier
     * @param bool $includeDeclinaisons
     * @param bool $includeRelatedItems
     */
    public function __construct($itemIdentifier, $includeDeclinaisons = false, $includeRelatedItems = false)
    {
        $this->itemIdentifier = $itemIdentifier;
        $this->includeDeclinaisons = !! $includeDeclinaisons;
        $this->includeRelatedItems = !! $includeRelatedItems;
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