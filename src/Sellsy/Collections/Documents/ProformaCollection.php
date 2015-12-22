<?php

namespace Sellsy\Collections\Documents;

use Sellsy\Collections\Collection;
use Sellsy\Models\Documents\Proforma;

/**
 * Class ProformaCollection
 * @package Sellsy\Collections\Documents
 */
class ProformaCollection extends Collection
{
    /**
     * Create a new item related to the collection type
     */
    public function createCollectionItem()
    {
        return new Proforma();
    }
}