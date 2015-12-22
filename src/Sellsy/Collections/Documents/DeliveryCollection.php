<?php

namespace Sellsy\Collections\Documents;

use Sellsy\Collections\Collection;
use Sellsy\Models\Documents\Delivery;

/**
 * Class DeliveryCollection
 * @package Sellsy\Collections\Documents
 */
class DeliveryCollection extends Collection
{
    /**
     * Create a new item related to the collection type
     */
    public function createCollectionItem()
    {
        return new Delivery();
    }
}