<?php

namespace Sellsy\Criteria;

/**
 * Class EmptyCriteria
 *
 * @package Sellsy\Criteria
 */
class EmptyCriteria implements CriteriaInterface
{
    /**
     * @return array
     */
    public function getParameters()
    {
        return array();
    }
}