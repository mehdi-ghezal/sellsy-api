<?php

namespace Sellsy\Criteria\Documents\SearchCriteria;

use Sellsy\Criteria\Documents\SearchCriteria;

/**
 * Class SearchDeliveriesCriteria
 * @package Sellsy\Criteria\Documents\SearchCriteria
 */
class SearchDeliveriesCriteria extends SearchCriteria
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
    const STEP_INVOICED_PARTIALLY = 'partialinvoiced';

    /**
     * @var string
     */
    const STEP_INVOICED = 'invoiced';

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
            self::STEP_DRAFT,
            self::STEP_SENT,
            self::STEP_READ,
            self::STEP_INVOICED_PARTIALLY,
            self::STEP_INVOICED
        );
    }
}