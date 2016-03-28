<?php

namespace Sellsy\Criteria\Documents;

use Sellsy\Criteria\CriteriaInterface;
use Sellsy\Models\Documents\DocumentInterface;

/**
 * Class UpdateStepCriteria
 *
 * @package Sellsy\Criteria\Documents
 */
class UpdateStepCriteria implements CriteriaInterface
{
    /**
     * @var DocumentInterface
     */
    protected $document;

    /**
     * UpdateStepCriteria constructor.
     *
     * @param DocumentInterface $document
     */
    public function __construct(DocumentInterface $document)
    {
        $this->document = $document;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return array(
            'docid'	=> $this->document->getId(),
            'document' => array(
                'doctype' => $this->document->getDoctype(),
                'step' => $this->document->getStep()->getId()
            )
        );
    }
}
