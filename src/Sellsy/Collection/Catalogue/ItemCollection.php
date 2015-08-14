<?php

namespace Sellsy\Collection\Catalogue;

use Sellsy\Collection\Collection;
use Sellsy\Models\Catalogue\Item;

/**
 * Class ItemCollection
 * @package Sellsy\Collection\Catalogue
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