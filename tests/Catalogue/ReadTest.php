<?php

namespace Sellsy\Tests\Catalogue;

use Sellsy\Criteria\Catalogue\GetItemCriteria;
use Sellsy\Criteria\Catalogue\SearchItemsCriteria;
use Sellsy\Clients\Catalogue;
use Sellsy\Models\Catalogue\Item;
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

        return $item;
    }

    /**
     * @param Item $item
     * @depends testGetItem
     */
    public function testItemMappings(Item $item)
    {
        $this->assertInternalType('integer', $item->id);
        $this->assertInternalType('float', $item->saleUnitAmountWithoutTax);
        $this->assertInternalType('float', $item->saleUnitTaxAmount);
        $this->assertInternalType('float', $item->purchaseUnitAmountWithoutTax);
        $this->assertInternalType('float', $item->purchaseUnitTaxAmount);
        $this->assertInternalType('float', $item->quantity);
        $this->assertInternalType('bool', $item->isActive);

        $this->assertInstanceOf('\DateTime', $item->createAt);
        $this->assertInstanceOf('\DateTime', $item->updateAt);

        $this->assertEquals('analyticsCode_value', $item->analyticsCode);
        $this->assertEquals('notes_value', $item->description);
        $this->assertEquals('public_path_value', $item->images);
        $this->assertEquals('name_value', $item->name);
        $this->assertEquals('tradename_value', $item->tradename);
        $this->assertEquals('slug_value', $item->slug);
        $this->assertEquals('unit_value', $item->unit);

        $this->assertInstanceOf('\Sellsy\Models\Catalogue\Item\Packaging', $item->packaging);
        $this->assertEquals('width_value', $item->packaging->width);
        $this->assertEquals('deepth_value', $item->packaging->deepth);
        $this->assertEquals('length_value', $item->packaging->length);
        $this->assertEquals('height_value', $item->packaging->height);
        $this->assertEquals('weight_value', $item->packaging->weight);
        $this->assertEquals('packing_value', $item->packaging->packing);

        //$this->assertInternalType('array', $item->customFields);
        //$this->assertGreaterThan(0, count($item->customFields));

        //$this->assertInternalType('array', $item->tags);
        //$this->assertGreaterThan(0, count($item->tags));
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
