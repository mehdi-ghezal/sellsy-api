<?php

namespace Sellsy\Tests\Generic;

use Sellsy\Client;
use Sellsy\Models\ApiInfos;
use Sellsy\Tests\Fixtures\Components;
use Sellsy\Models\ApiInfosInterface;

/**
 * Class ClientTest
 *
 * @package Sellsy\Tests\Generic
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return Client
     */
    public function testNewClient()
    {
        $client = Components::getClient();

        $this->assertInstanceOf('Sellsy\Client', $client);

        return $client;
    }

    /**
     * @param Client $client
     * @return ApiInfosInterface
     * @depends testNewClient
     */
    public function testGetApiInfos(Client $client)
    {
        $infos = $client->getApiInfos();

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
