<?php

namespace Sellsy\Collections\Documents;

use Sellsy\Collections\Collection;
use Sellsy\Models\Documents\Order;

/**
 * Class OrderCollection
 * @package Sellsy\Collections\Documents
 */
class OrderCollection extends Collection
{
    /**
     * Create a new item related to the collection type
     */
    public function createCollectionItem()
    {
        return new Order();
    }
}