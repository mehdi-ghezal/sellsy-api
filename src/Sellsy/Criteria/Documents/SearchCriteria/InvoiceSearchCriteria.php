<?php

namespace Sellsy\Criteria\Documents\SearchCriteria;

use Sellsy\Criteria\Documents\SearchCriteria;

/**
 * Class InvoiceSearchCriteria
 * @package Sellsy\Criteria\Documents\SearchCriteria
 */
class InvoiceSearchCriteria extends SearchCriteria
{
    /**
     * @var string
     */
    const STEP_DRAFT = 'draft';

    /**
     * @var string
     */
    const STEP_PAYMENT_DUE = 'due';

    /**
     * @var string
     */
    const STEP_PAYMENT_PARTIAL = 'payinprogress';

    /**
     * @var string
     */
    const STEP_PAYMENT_DONE = 'paid';

    /**
     * @var string
     */
    const STEP_PAYMENT_LATE = 'late';

    /**
     * @var string
     */
    const STEP_CANCELED = 'cancelled';

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
            self::STEP_DRAFT,
            self::STEP_PAYMENT_DUE,
            self::STEP_PAYMENT_PARTIAL,
            self::STEP_PAYMENT_DONE,
            self::STEP_PAYMENT_LATE,
            self::STEP_CANCELED
        );
    }
}