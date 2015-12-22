<?php

namespace Sellsy\Collections\Documents;

use Sellsy\Collections\Collection;
use Sellsy\Models\Documents\Estimate;

/**
 * Class EstimateCollection
 * @package Sellsy\Collections\Documents
 */
class EstimateCollection extends Collection
{
    /**
     * Create a new item related to the collection type
     */
    public function createCollectionItem()
    {
        return new Estimate();
    }
}