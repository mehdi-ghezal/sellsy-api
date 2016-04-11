<?php

namespace Sellsy\Tests\Sellsy\Criteria\Client;

use Sellsy\Criteria\Client\SearchCustomersCriteria;
use Sellsy\Criteria\CriteriaInterface;
use Sellsy\Exception\RuntimeException;

/**
 * Class SearchCustomersCriteriaTest
 *
 * @package Sellsy\Tests\Sellsy\Criteria\Client
 */
class SearchCustomersCriteriaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return SearchCustomersCriteria
     */
    public function testImplementCriteriaInterface()
    {
        $criteria = new SearchCustomersCriteria();
        $this->assertInstanceOf(CriteriaInterface::class, $criteria);

        return $criteria;
    }

    /**
     * @param SearchCustomersCriteria $criteria
     * @return SearchCustomersCriteria
     *
     * @depends testImplementCriteriaInterface
     */
    public function testGetParametersIsArray(SearchCustomersCriteria $criteria)
    {
        $this->assertInternalType('array', $criteria->getParameters());

        return $criteria;
    }

    /**
     * @param SearchCustomersCriteria $criteria
     * @return void
     *
     * @depends testGetParametersIsArray
     */
    public function testGetParametersIsEmptyArray(SearchCustomersCriteria $criteria)
    {
        $this->assertEmpty($criteria->getParameters());
    }

    /**
     * @param SearchCustomersCriteria $criteria
     * @return void
     *
     * @depends testGetParametersIsArray
     */
    public function testSetTypePerson(SearchCustomersCriteria $criteria)
    {
        $criteria->setType(SearchCustomersCriteria::TYPE_PERSON);
        $parameters = $criteria->getParameters();

        $this->assertTrue(isset($parameters['search']['type']));
        $this->assertEquals('person', $parameters['search']['type']);
    }

    /**
     * @param SearchCustomersCriteria $criteria
     * @return void
     *
     * @depends testGetParametersIsArray
     */
    public function testSetTypeCompany(SearchCustomersCriteria $criteria)
    {
        $criteria->setType(SearchCustomersCriteria::TYPE_COMPANY);
        $parameters = $criteria->getParameters();

        $this->assertTrue(isset($parameters['search']['type']));
        $this->assertEquals('corporation', $parameters['search']['type']);
    }

    /**
     * @param SearchCustomersCriteria $criteria
     * @return void
     *
     * @depends testGetParametersIsArray
     */
    public function testSetTypeUnknown(SearchCustomersCriteria $criteria)
    {
        $this->setExpectedException(RuntimeException::class);
        $criteria->setType('woot');
    }

    /**
     * @param SearchCustomersCriteria $criteria
     * @return void
     *
     * @depends testGetParametersIsArray
     */
    public function testSetTags(SearchCustomersCriteria $criteria)
    {
        $criteria->setTags(array('hello', 'world'));
        $parameters = $criteria->getParameters();

        $this->assertTrue(isset($parameters['search']['tags']));
        $this->assertEquals('hello,world', $parameters['search']['tags']);
    }
}
