<?php

namespace Sellsy\Criteria\Documents\SearchCriteria;

use Sellsy\Criteria\Documents\SearchCriteria;
use Sellsy\Models\Documents\Document\StepInterface;

/**
 * Class SearchInvoicesCriteria
 * @package Sellsy\Criteria\Documents\SearchCriteria
 */
class SearchInvoicesCriteria extends SearchCriteria
{
    /**
     * @var bool
     */
    protected $includePayments = false;

    /**
     * @param bool|true $includePayments
     * @return $this
     */
    public function setIncludePayments($includePayments = true)
    {
        $this->includePayments = !! $includePayments;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isIncludePayments()
    {
        return $this->includePayments;
    }

    /**
     * @return string
     */
    protected function getType()
    {
        return 'invoice';
    }

    /**
     * @return array
     */
    protected function getValidSteps()
    {
        return array(
            StepInterface::STEP_DRAFT,
            StepInterface::STEP_PAYMENT_DUE,
            StepInterface::STEP_PAYMENT_PARTIAL,
            StepInterface::STEP_PAYMENT_DONE,
            StepInterface::STEP_PAYMENT_LATE,
            StepInterface::STEP_CANCELLED
        );
    }

    /**
     * @inheritdoc
     */
    public function getParameters()
    {
        $parameters = parent::getParameters();
        $parameters['includePayments'] = $this->includePayments ? 'Y' : 'N';

        return $parameters;
    }
}