<?php

namespace Sellsy\Criteria\Documents\SearchCriteria;

use Sellsy\Criteria\Documents\SearchCriteria;

/**
 * Class EstimateSearchCriteria
 * @package Sellsy\Criteria\Documents\SearchCriteria
 */
class EstimateSearchCriteria extends SearchCriteria
{
    /**
     * @var string
     */
    const STEP_DRAFT = 'draft';

    /**
     * @var string
     */
    const STEP_SENT = 'sent';

    /**
     * @var string
     */
    const STEP_READ = 'read';

    /**
     * @var string
     */
    const STEP_ACCEPTED = 'accepted';

    /**
     * @var string
     */
    const STEP_REFUSED = 'refused';

    /**
     * @var string
     */
    const STEP_EXPIRED = 'expired';

    /**
     * @var string
     */
    const STEP_DEPOSIT_RECEIVED = 'advanced';

    /**
     * @var string
     */
    const STEP_INVOICED = 'invoiced';

    /**
     * @var string
     */
    const STEP_CANCELLED = 'cancelled';

    /**
     * @return string
     */
    protected function getType()
    {
        return 'estimate';
    }

    /**
     * @return array
     */
    protected function getValidSteps()
    {
        return array(
            self::STEP_DRAFT,
            self::STEP_SENT,
            self::STEP_READ,
            self::STEP_ACCEPTED,
            self::STEP_REFUSED,
            self::STEP_EXPIRED,
            self::STEP_DEPOSIT_RECEIVED,
            self::STEP_INVOICED,
            self::STEP_CANCELLED
        );
    }
}