<?php

namespace Sellsy\Criteria\Documents\SearchCriteria;

use Sellsy\Criteria\Documents\SearchCriteria;
use Sellsy\Models\Documents\Document\StepInterface;

/**
 * Class SearchDeliveriesCriteria
 * @package Sellsy\Criteria\Documents\SearchCriteria
 */
class SearchDeliveriesCriteria extends SearchCriteria
{
    /**
     * @return string
     */
    protected function getType()
    {
        return 'delivery';
    }

    /**
     * @return array
     */
    protected function getValidSteps()
    {
        return array(
            StepInterface::STEP_DRAFT,
            StepInterface::STEP_SENT,
            StepInterface::STEP_READ,
            StepInterface::STEP_INVOICED_PARTIALLY,
            StepInterface::STEP_INVOICED
        );
    }
}