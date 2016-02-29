<?php

namespace Sellsy\Criteria\Documents\SearchCriteria;

use Sellsy\Criteria\Documents\SearchCriteria;

/**
 * Class SearchProformaCriteria
 * @package Sellsy\Criteria\Documents\SearchCriteria
 */
class SearchProformaCriteria extends SearchCriteria
{
    /**
     * @var string
     */
    const STEP_DRAFT = 'draft';

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
        return 'proforma';
    }

    /**
     * @return array
     */
    protected function getValidSteps()
    {
        return array(
            self::STEP_DRAFT,
            self::STEP_READ,
            self::STEP_ACCEPTED,
            self::STEP_EXPIRED,
            self::STEP_DEPOSIT_RECEIVED,
            self::STEP_INVOICED,
            self::STEP_CANCELLED
        );
    }
}