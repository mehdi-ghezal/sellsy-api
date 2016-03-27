<?php

namespace Sellsy\Tests\Criteria\Documents;

use Sellsy\Criteria\Documents\SearchCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\SearchInvoicesCriteria;
use Sellsy\Models\Documents\Document\StepInterface;

class SearchCriteriaTest extends \PHPUnit_Framework_TestCase
{
    public function testAddAllStepsExceptWithString()
    {
        /** @var SearchCriteria $criteria */
        $criteria = new SearchInvoicesCriteria();
        $criteria->addAllStepsExcept(StepInterface::STEP_DRAFT);

        $criteriaSteps = $criteria->getSteps();
        $expectedSteps = array(
            StepInterface::STEP_CANCELLED,
            StepInterface::STEP_PAYMENT_LATE,
            StepInterface::STEP_PAYMENT_PARTIAL,
            StepInterface::STEP_PAYMENT_DONE,
            StepInterface::STEP_PAYMENT_DUE,
        );

        $this->assertTrue(array_diff($criteriaSteps, $expectedSteps) === array_diff($expectedSteps, $criteriaSteps));
    }

    public function testAddAllStepsExceptWithArray()
    {
        /** @var SearchCriteria $criteria */
        $criteria = new SearchInvoicesCriteria();
        $criteria->addAllStepsExcept(array(StepInterface::STEP_DRAFT, StepInterface::STEP_CANCELLED));

        $criteriaSteps = $criteria->getSteps();
        $expectedSteps = array(
            StepInterface::STEP_PAYMENT_LATE,
            StepInterface::STEP_PAYMENT_PARTIAL,
            StepInterface::STEP_PAYMENT_DONE,
            StepInterface::STEP_PAYMENT_DUE,
        );

        $this->assertTrue(array_diff($criteriaSteps, $expectedSteps) === array_diff($expectedSteps, $criteriaSteps));
    }
}