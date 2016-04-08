<?php

namespace Sellsy\Criteria\Documents\GetDocumentCriteria;

use Sellsy\Criteria\Documents\GetDocumentCriteria;

/**
 * Class GetDeliveryCriteria
 *
 * @package Sellsy\Criteria\Documents\GetDocumentCriteria
 */
class GetDeliveryCriteria extends GetDocumentCriteria
{
    /**
     * @return string
     */
    public function getDoctype()
    {
        return 'delivery';
    }
}