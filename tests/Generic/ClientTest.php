<?php

namespace Sellsy\Tests\Generic;

use Sellsy\Client;
use Sellsy\Tests\Fixtures\Clients;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testNewClient()
    {
        $client = Clients::getValidClient();

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
    }
}
