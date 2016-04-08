<?php

namespace Sellsy\Criteria\Documents;

use Sellsy\Criteria\Generic\GetOneCriteria;

/**
 * Class GetDocumentCriteria
 *
 * @package Sellsy\Criteria\Documents
 */
abstract class GetDocumentCriteria extends GetOneCriteria
{
    /**
     * @return array
     */
    public function getParameters()
    {
        return array(
            'doctype' => $this->getDoctype(),
            'docid' => $this->id
        );
    }

    /**
     * @return string
     */
    abstract protected function getDoctype();
}
