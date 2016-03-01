<?php

namespace Sellsy\Tests\Catalogue;

use Sellsy\Criteria\Catalogue\GetItemCriteria;
use Sellsy\Criteria\Catalogue\SearchItemsCriteria;
use Sellsy\Clients\Catalogue;
use Sellsy\Tests\Fixtures\Catalogue as CatalogueFixtures;
use Sellsy\Tests\Fixtures\Components;
use Sellsy\Tests\Generic\ClientTest;
use Sellsy\Models\Catalogue\ItemInterface;
use Sellsy\Tests\Fixtures\NewItem;

class ReadTest extends ClientTest
{
    public function testCatalogueClient()
    {
        $catalogue = Components::getClient()->catalogue();

        $this->assertInstanceOf('Sellsy\Clients\Catalogue', $catalogue);

        return $catalogue;
    }

    /**
     * @depends testCatalogueClient
     */
    public function testGetItem(Catalogue $catalogue)
    {
        $item = $catalogue->getItem(new GetItemCriteria(CATALOGUE_ITEM_ID));

        $this->assertInstanceOf('Sellsy\Models\Catalogue\ItemInterface', $item);
    }

    /**
     * @depends testCatalogueClient
     */
    public function testSearchItems(Catalogue $catalogue)
    {
        Components::getMapper()->setInterfaceMapping(ItemInterface::class, NewItem::class);

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
