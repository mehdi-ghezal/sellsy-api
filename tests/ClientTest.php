<?php

namespace Sellsy\Tests;

use Minime\Annotations\Cache\ArrayCache;
use Minime\Annotations\Parser;
use Minime\Annotations\Reader;
use Sellsy\Adapters\BaseAdapter;
use Sellsy\Client;
use Sellsy\Clients\Catalogue;
use Sellsy\Mappers\BaseMapper;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testInstantiate()
    {
        $reader = new Reader(new Parser(), new ArrayCache());
        $mapper = new BaseMapper($reader);

        $adapter = new BaseAdapter(Credentials::$consumerToken, Credentials::$consumerSecret, Credentials::$userToken, Credentials::$userSecret);
        $adapter->setMapper($mapper);

        $client = new Client($adapter);

        $this->assertInstanceOf('Sellsy\Client', $client);

        return $client;
    }

    /**
     * @depends testInstantiate
     */
    public function testInfos(Client $client)
    {
        $infos = $client->getApiInfos();

        $this->assertInstanceOf('Sellsy\Models\ApiInfos', $infos);
    }

    /**
     * @depends testInstantiate
     */
    public function testCatalogue(Client $client)
    {
        $catalogue = $client->catalogue();

        $this->assertInstanceOf('Sellsy\Clients\Catalogue', $catalogue);

        return $catalogue;
    }

    /**
     * @depends testCatalogue
     */
    public function testCatalogueItem(Catalogue $catalogue)
    {
        $item = $catalogue->getItem(new Catalogue\ItemCriteria(Fixtures::$catalogueItem));

        $this->assertInstanceOf('Sellsy\Models\Catalogue\Item', $item);
    }

    /**
     * @depends testCatalogue
     */
    public function testCatalogueSearchItems(Catalogue $catalogue)
    {
        $items = $catalogue->searchItems(new Catalogue\ItemsSearchCriteria());

        $this->assertInstanceOf('Sellsy\Collection\Catalogue\ItemCollection', $items);
    }

    public function initializeTestApp()
    {
        if (! file_exists(__DIR__ . '/Fixtures.php')) {
            throw new \RuntimeException('You must create a Fixtures.php file from Fixtures.php.dist and fill all the values');
        }

        if (! file_exists(__DIR__ . '/Credentials.php')) {
            throw new \RuntimeException('You must create a Credentials.php file from Credentials.php.dist');
        }

        if (! Credentials::$consumerToken || ! Credentials::$consumerSecret || ! Credentials::$userToken || ! Credentials::$userSecret) {
            throw new \RuntimeException('You must fill out Credentials.php');
        }
    }
}
