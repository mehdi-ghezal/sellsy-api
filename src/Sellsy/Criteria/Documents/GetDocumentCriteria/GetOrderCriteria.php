<?php

namespace Sellsy\Criteria\Documents\GetDocumentCriteria;

use Sellsy\Criteria\Documents\GetDocumentCriteria;

/**
 * Class GetOrderCriteria
 *
 * @package Sellsy\Criteria\Documents\GetDocumentCriteria
 */
class GetOrderCriteria extends GetDocumentCriteria
{
    /**
     * @return string
     */
    public function getDoctype()
    {
        return 'order';
    }
}