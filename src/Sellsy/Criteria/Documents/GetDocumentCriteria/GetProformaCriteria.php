<?php

namespace Sellsy\Criteria\Documents\GetDocumentCriteria;

use Sellsy\Criteria\Documents\GetDocumentCriteria;

/**
 * Class GetProformaCriteria
 *
 * @package Sellsy\Criteria\Documents\GetDocumentCriteria
 */
class GetProformaCriteria extends GetDocumentCriteria
{
    /**
     * @return string
     */
    public function getDoctype()
    {
        return 'proforma';
    }
}