<?php

namespace Sellsy\Tests\Sellsy\Criteria;

use Sellsy\Criteria\CriteriaInterface;
use Sellsy\Criteria\EmptyCriteria;

/**
 * Class EmptyCriteriaTest
 *
 * @package Sellsy\Tests\Sellsy\Criteria
 */
class EmptyCriteriaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return EmptyCriteria
     */
    public function testImplementCriteriaInterface()
    {
        $criteria = new EmptyCriteria();
        $this->assertInstanceOf(CriteriaInterface::class, $criteria);

        return $criteria;
    }

    /**
     * @param EmptyCriteria $criteria
     * @return EmptyCriteria
     *
     * @depends testImplementCriteriaInterface
     */
    public function testGetParametersIsArray(EmptyCriteria $criteria)
    {
        $this->assertInternalType('array', $criteria->getParameters());

        return $criteria;
    }

    /**
     * @param EmptyCriteria $criteria
     * @return void
     *
     * @depends testGetParametersIsArray
     */
    public function testGetParametersIsEmpty(EmptyCriteria $criteria)
    {
        $this->assertEquals(0, count($criteria->getParameters()));
    }
}
