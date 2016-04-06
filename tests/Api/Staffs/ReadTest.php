<?php

namespace Sellsy\Tests\Api\Staffs;

use Sellsy\Api\Staffs;
use Sellsy\Models\Documents\Document;
use Sellsy\Models\Staff\PeopleInterface;
use Sellsy\Tests\Fixtures\Components;

class ReadTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return Staffs
     */
    public function testStaffsApi()
    {
        $staffs = Components::getApi()->staffs();

        $this->assertInstanceOf('Sellsy\Api\Staffs', $staffs);

        return $staffs;
    }

    /**
     * @param Staffs $staffs
     * @return PeopleInterface
     * @depends testStaffsApi
     */
    public function testListPeoples(Staffs $staffs)
    {
        $peoples = $staffs->listAll();
        $people = $peoples->current();

        $this->assertInstanceOf('Sellsy\Collections\Collection', $peoples);
        $this->assertInstanceOf('Sellsy\Models\Staff\PeopleInterface', $people);

        return $people;
    }

    /**
     * @param PeopleInterface $people
     * @depends testListPeoples
     */
    public function testPeopleMapping(PeopleInterface $people)
    {
        $this->assertInstanceOf('\DateTime', $people->getCreateAt());
        $this->assertInstanceOf('\DateTime', $people->getUpdateAt());

        $this->assertGreaterThan(1, $people->getId());

        $people->getMobileNumber();
        $people->getFullName();
        $people->getEmail();
        $people->getFirstName();
        $people->getLastName();
        $people->getPhoneNumber();

        $people->getAvatar();
        $people->getPicture();
    }
}
