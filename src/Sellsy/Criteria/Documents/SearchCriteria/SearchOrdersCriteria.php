<?php

namespace Sellsy\Criteria\Documents\SearchCriteria;

use Sellsy\Criteria\Documents\SearchCriteria;
use Sellsy\Models\Documents\Document\StepInterface;

/**
 * Class SearchOrdersCriteria
 * @package Sellsy\Criteria\Documents\SearchCriteria
 */
class SearchOrdersCriteria extends SearchCriteria
{
    /**
     * @return string
     */
    protected function getType()
    {
        return 'order';
    }

    /**
     * @return array
     */
    protected function getValidSteps()
    {
        return array(
            StepInterface::STEP_DRAFT,
            StepInterface::STEP_READ,
            StepInterface::STEP_ACCEPTED,
            StepInterface::STEP_EXPIRED,
            StepInterface::STEP_DEPOSIT,
            StepInterface::STEP_INVOICED,
            StepInterface::STEP_CANCELLED
        );
    }
}