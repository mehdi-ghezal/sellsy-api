<?php

namespace Sellsy\Criteria\Documents\GetDocumentCriteria;

use Sellsy\Criteria\Documents\GetDocumentCriteria;

/**
 * Class GetInvoiceCriteria
 *
 * @package Sellsy\Criteria\Documents\GetDocumentCriteria
 */
class GetInvoiceCriteria extends GetDocumentCriteria
{
    /**
     * @return string
     */
    public function getDoctype()
    {
        return 'invoice';
    }
}