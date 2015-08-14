<?php

namespace Sellsy\Collections\Catalogue;

use Sellsy\Collections\Collection;
use Sellsy\Models\Catalogue\Item;

/**
 * Class ItemCollection
 * @package Sellsy\Collections\Catalogue
 */
class ItemCollection extends Collection
{
    /**
     * Create a new item related to the collection type
     */
    public function createCollectionItem()
    {
        return new Item();
    }
}