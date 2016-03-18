<?php

namespace Sellsy\Tests\Criteria\Documents;

use Sellsy\Criteria\Documents\SearchCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\SearchInvoicesCriteria;

class SearchCriteriaTest extends \PHPUnit_Framework_TestCase
{
    public function testAddAllStepsExceptWithString()
    {
        /** @var SearchCriteria $criteria */
        $criteria = new SearchInvoicesCriteria();
        $criteria->addAllStepsExcept(SearchInvoicesCriteria::STEP_DRAFT);

        $criteriaSteps = $criteria->getSteps();
        $expectedSteps = array(
            SearchInvoicesCriteria::STEP_CANCELED,
            SearchInvoicesCriteria::STEP_PAYMENT_LATE,
            SearchInvoicesCriteria::STEP_PAYMENT_PARTIAL,
            SearchInvoicesCriteria::STEP_PAYMENT_DONE,
            SearchInvoicesCriteria::STEP_PAYMENT_DUE,
        );

        $this->assertTrue(array_diff($criteriaSteps, $expectedSteps) === array_diff($expectedSteps, $criteriaSteps));
    }

    public function testAddAllStepsExceptWithArray()
    {
        /** @var SearchCriteria $criteria */
        $criteria = new SearchInvoicesCriteria();
        $criteria->addAllStepsExcept(array(SearchInvoicesCriteria::STEP_DRAFT, SearchInvoicesCriteria::STEP_CANCELED));

        $criteriaSteps = $criteria->getSteps();
        $expectedSteps = array(
            SearchInvoicesCriteria::STEP_PAYMENT_LATE,
            SearchInvoicesCriteria::STEP_PAYMENT_PARTIAL,
            SearchInvoicesCriteria::STEP_PAYMENT_DONE,
            SearchInvoicesCriteria::STEP_PAYMENT_DUE,
        );

        $this->assertTrue(array_diff($criteriaSteps, $expectedSteps) === array_diff($expectedSteps, $criteriaSteps));
    }
}