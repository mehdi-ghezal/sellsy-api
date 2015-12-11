<?php

namespace Sellsy\Tests\Catalogue;

use Sellsy\Clients\Catalogue\ItemCriteria;
use Sellsy\Clients\Catalogue\ItemsSearchCriteria;
use Sellsy\Clients\Catalogue;
use Sellsy\Tests\Fixtures\Catalogue as CatalogueFixtures;
use Sellsy\Tests\Fixtures\Clients;
use Sellsy\Tests\Generic\ClientTest;

class ReadTest extends ClientTest
{
    public function testCatalogueClient()
    {
        $catalogue = Clients::getValidClient()->catalogue();

        $this->assertInstanceOf('Sellsy\Clients\Catalogue', $catalogue);

        return $catalogue;
    }

    /**
     * @depends testCatalogueClient
     */
    public function testGetItem(Catalogue $catalogue)
    {
        $item = $catalogue->getItem(new ItemCriteria(CatalogueFixtures::$catalogueItem));

        $this->assertInstanceOf('Sellsy\Models\Catalogue\Item', $item);
    }

    /**
     * @depends testCatalogueClient
     */

    public function testSearchItems(Catalogue $catalogue)
    {
        $items = $catalogue->searchItems(new ItemsSearchCriteria());

        $this->assertInstanceOf('Sellsy\Collections\Catalogue\ItemCollection', $items);
    }
}
