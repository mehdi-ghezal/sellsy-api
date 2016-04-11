<?php

namespace Sellsy\Tests\Sellsy\Criteria\Generic;

use Sellsy\Criteria\CriteriaInterface;
use Sellsy\Criteria\Generic\GetOneCriteria;

/**
 * Class GetOneTest
 *
 * @package Sellsy\Tests\Sellsy\Criteria\Generic
 */
class GetOneTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function testImplementCriteriaInterface()
    {
        $criteria = $this->getMockForAbstractClass(GetOneCriteria::class);
        $this->assertInstanceOf(CriteriaInterface::class, $criteria);
    }

    /**
     * @param \PHPUnit_Framework_MockObject_MockObject $criteria
     * @return \PHPUnit_Framework_MockObject_MockObject
     *
     * @depends testImplementCriteriaInterface
     */
    public function testSetId(\PHPUnit_Framework_MockObject_MockObject $criteria)
    {
        $criteria->setId(12);
        $this->assertEquals(12, $criteria->getId());

        return $criteria;
    }

    /**
     * @param \PHPUnit_Framework_MockObject_MockObject $criteria
     * @return \PHPUnit_Framework_MockObject_MockObject
     *
     * @depends testSetId
     */
    public function testGetParametersIsArray(\PHPUnit_Framework_MockObject_MockObject $criteria)
    {
        $this->assertInternalType('array', $criteria->getParameters());

        return $criteria;
    }

    /**
     * @param \PHPUnit_Framework_MockObject_MockObject $criteria
     *
     * @depends testGetParametersIsArray
     */
    public function testGetParametersArrayHasIdKey(\PHPUnit_Framework_MockObject_MockObject $criteria)
    {
        $this->assertArrayHasKey('id', $criteria->getParameters());
    }
}
