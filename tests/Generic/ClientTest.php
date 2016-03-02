<?php

namespace Sellsy\Tests\Generic;

use Sellsy\Client;
use Sellsy\Models\ApiInfos;
use Sellsy\Tests\Fixtures\Components;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testNewClient()
    {
        $client = Components::getClient();

        $this->assertInstanceOf('Sellsy\Client', $client);

        return $client;
    }

    /**
     * @depends testNewClient
     */
    public function testGetApiInfos(Client $client)
    {
        $infos = $client->getApiInfos();

        $this->assertInstanceOf('Sellsy\Models\ApiInfos', $infos);

        return $infos;
    }

    /**
     * @param ApiInfos $infos
     * @depends testGetApiInfos
     */
    public function testApiInfosMapping(ApiInfos $infos)
    {
        $this->assertEquals("status_value", $infos->status);
        $this->assertEquals("version_value", $infos->version);

        $this->assertGreaterThan(1, $infos->account->id);
        $this->assertEquals("forename_value", $infos->account->firstName);
        $this->assertEquals("name_value", $infos->account->lastName);
        $this->assertEquals("mail_value", $infos->account->email);
        $this->assertEquals("fullName_value", $infos->account->fullName);
    }
}
