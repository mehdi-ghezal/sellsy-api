<?php

namespace Sellsy\Tests\Generic;

use Sellsy\Client;
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
    }
}
