<?php

namespace Sellsy\Tests\Catalogue;

use Sellsy\Criteria\Catalogue\GetItemCriteria;
use Sellsy\Criteria\Catalogue\SearchItemsCriteria;
use Sellsy\Clients\Catalogue;
use Sellsy\Tests\Fixtures\Catalogue as CatalogueFixtures;
use Sellsy\Tests\Fixtures\Clients;
use Sellsy\Tests\Generic\ClientTest;
use Sellsy\Models\Catalogue\ItemInterface;

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
        $item = $catalogue->getItem(new GetItemCriteria(CatalogueFixtures::$catalogueItem));

        $this->assertInstanceOf('Sellsy\Models\Catalogue\ItemInterface', $item);
    }

    /**
     * @depends testCatalogueClient
     */
    public function testSearchItems(Catalogue $catalogue)
    {
        $items = $catalogue->searchItems(new SearchItemsCriteria());

        $this->assertInstanceOf('Sellsy\Collections\Collection', $items);
        $this->assertInstanceOf('Sellsy\Models\Catalogue\ItemInterface', $items->current());

        return $items->current();
    }

    /**
     * @depends testSearchItems
     */
    public function testInterfacesMappings(ItemInterface $item)
    {
        $this->assertInstanceOf('Sellsy\Tests\Fixtures\NewItem', $item);
    }
}
