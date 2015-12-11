<?php

namespace Sellsy\Collections\Documents;

use Sellsy\Collections\Collection;
use Sellsy\Models\Documents\Document;

/**
 * Class DocumentCollection
 * @package Sellsy\Collections\Catalogue
 */
class DocumentCollection extends Collection
{
    /**
     * Create a new item related to the collection type
     */
    public function createCollectionItem()
    {
        return new Document();
    }
}