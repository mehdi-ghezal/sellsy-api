<?php

namespace Sellsy\Criteria\Documents\SearchCriteria;

use Sellsy\Criteria\Documents\SearchCriteria;

/**
 * Class DeliverySearchCriteria
 * @package Sellsy\Criteria\Documents\SearchCriteria
 */
class DeliverySearchCriteria extends SearchCriteria
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
            self::STEP_READ
        );
    }
}