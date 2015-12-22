<?php

namespace Sellsy\Collections\Documents;

use Sellsy\Collections\Collection;
use Sellsy\Models\Documents\Invoice;

/**
 * Class InvoiceCollection
 * @package Sellsy\Collections\Documents
 */
class InvoiceCollection extends Collection
{
    /**
     * Create a new item related to the collection type
     */
    public function createCollectionItem()
    {
        return new Invoice();
    }
}