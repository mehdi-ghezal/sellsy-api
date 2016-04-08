<?php

namespace Sellsy\Criteria\Documents\GetDocumentCriteria;

use Sellsy\Criteria\Documents\GetDocumentCriteria;

/**
 * Class GetEstimateCriteria
 *
 * @package Sellsy\Criteria\Documents\GetDocumentCriteria
 */
class GetEstimateCriteria extends GetDocumentCriteria
{
    /**
     * @return string
     */
    public function getDoctype()
    {
        return 'estimate';
    }
}