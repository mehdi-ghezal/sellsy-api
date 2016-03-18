<?php

namespace Sellsy\Tests\Api\Generic;

use Sellsy\Api;
use Sellsy\Tests\Fixtures\Components;
use Sellsy\Models\ApiInfosInterface;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return Api
     */
    public function testNewApi()
    {
        $api = Components::getApi();

        $this->assertInstanceOf('Sellsy\Api', $api);

        return $api;
    }

    /**
     * @param Api $api
     * @return ApiInfosInterface
     * @depends testNewApi
     */
    public function testGetApiInfos(Api $api)
    {
        $infos = $api->getApiInfos();

        $this->assertInstanceOf('Sellsy\Models\ApiInfosInterface', $infos);

        return $infos;
    }

    /**
     * @param ApiInfosInterface $infos
     * @depends testGetApiInfos
     */
    public function testApiInfosMapping(ApiInfosInterface $infos)
    {
        $this->assertEquals("status_value", $infos->getStatus());
        $this->assertEquals("version_value", $infos->getVersion());

        $this->assertGreaterThan(1, $infos->getAccount()->getId());
        $this->assertEquals("forename_value", $infos->getAccount()->getFirstName());
        $this->assertEquals("name_value", $infos->getAccount()->getLastName());
        $this->assertEquals("mail_value", $infos->getAccount()->getEmail());
        $this->assertEquals("fullName_value", $infos->getAccount()->getFullName());
    }
}
