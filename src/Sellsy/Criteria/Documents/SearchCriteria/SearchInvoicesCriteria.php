<?php

namespace Sellsy\Criteria\Documents\SearchCriteria;

use Sellsy\Criteria\Documents\SearchCriteria;

/**
 * Class SearchInvoicesCriteria
 * @package Sellsy\Criteria\Documents\SearchCriteria
 */
class SearchInvoicesCriteria extends SearchCriteria
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
            self::STEP_DRAFT,
            self::STEP_PAYMENT_DUE,
            self::STEP_PAYMENT_PARTIAL,
            self::STEP_PAYMENT_DONE,
            self::STEP_PAYMENT_LATE,
            self::STEP_CANCELED
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