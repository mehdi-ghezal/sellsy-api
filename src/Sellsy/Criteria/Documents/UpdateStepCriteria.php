<?php

namespace Sellsy\Criteria\Documents;

use Sellsy\Criteria\CriteriaInterface;
use Sellsy\Models\Documents\Document\StepInterface;
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
     * @var StepInterface
     */
    protected $step;

    /**
     * UpdateStepCriteria constructor.
     *
     * @param DocumentInterface $document
     * @param StepInterface $step
     */
    public function __construct(DocumentInterface $document, StepInterface $step)
    {
        $this->document = $document;
        $this->step = $step;
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
			        'step' => $this->step->getId()
		    )
        );
    }
}
