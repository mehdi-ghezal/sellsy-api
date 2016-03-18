<?php

namespace Sellsy\Tests\Api\Catalogue;

use Sellsy\Api\Catalogue;
use Sellsy\Criteria\Catalogue\GetItemCriteria;
use Sellsy\Criteria\Catalogue\SearchItemsCriteria;
use Sellsy\Tests\Fixtures\Components;
use Sellsy\Models\Catalogue\ItemInterface;
use Sellsy\Tests\Fixtures\NewItem;

class ReadTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return Catalogue
     */
    public function testCatalogueApi()
    {
        $catalogue = Components::getApi()->catalogue();

        $this->assertInstanceOf('Sellsy\Api\Catalogue', $catalogue);

        return $catalogue;
    }

    /**
     * @param Catalogue $catalogue
     * @return ItemInterface
     * @depends testCatalogueApi
     */
    public function testGetItem(Catalogue $catalogue)
    {
        $item = $catalogue->getItem(new GetItemCriteria(CATALOGUE_ITEM_ID));

        $this->assertInstanceOf('Sellsy\Models\Catalogue\ItemInterface', $item);

        return $item;
    }

    /**
     * @param ItemInterface $item
     * @depends testGetItem
     */
    public function testItemMappings(ItemInterface $item)
    {
        $this->assertInternalType('integer', $item->getId());
        $this->assertInternalType('float', $item->getSaleUnitAmountWithoutTax());
        $this->assertInternalType('float', $item->getSaleUnitTaxAmount());
        $this->assertInternalType('float', $item->getPurchaseUnitAmountWithoutTax());
        $this->assertInternalType('float', $item->getPurchaseUnitTaxAmount());
        $this->assertInternalType('float', $item->getQuantity());
        $this->assertInternalType('bool', $item->isActive());

        $this->assertInstanceOf('\DateTime', $item->getCreateAt());
        $this->assertInstanceOf('\DateTime', $item->getUpdateAt());

        $this->assertEquals('analyticsCode_value', $item->getAnalyticsCode());
        $this->assertEquals('notes_value', $item->getDescription());
        $this->assertEquals('https://www.sellsy.fr/public_path_value', $item->getImage());
        $this->assertEquals('name_value', $item->getName());
        $this->assertEquals('tradename_value', $item->getTradename());
        $this->assertEquals('slug_value', $item->getSlug());
        $this->assertEquals('unit_value', $item->getUnit());

        $this->assertInstanceOf('\Sellsy\Models\Catalogue\Item\Packaging', $item->getPackaging());
        $this->assertEquals('width_value', $item->getPackaging()->getWidth());
        $this->assertEquals('deepth_value', $item->getPackaging()->getDeepth());
        $this->assertEquals('length_value', $item->getPackaging()->getLength());
        $this->assertEquals('height_value', $item->getPackaging()->getHeight());
        $this->assertEquals('weight_value', $item->getPackaging()->getWeight());
        $this->assertEquals('packing_value', $item->getPackaging()->getPacking());

        $this->assertInstanceOf('Sellsy\Models\SmartTags\TagInterface', $item->getTag(function() { return true; }));
        $this->assertInternalType('array', $item->getTags());
        $this->assertGreaterThan(0, count($item->getTags()));

        $this->assertInstanceOf('Sellsy\Models\CustomFields\CustomFieldInterface', $item->getCustomField(function() { return true; }));
        $this->assertInternalType('array', $item->getCustomFields());
        $this->assertGreaterThan(0, count($item->getCustomFields()));
    }

    /**
     * @param Catalogue $catalogue
     * @return ItemInterface
     * @depends testCatalogueApi
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
     * @param ItemInterface $item
     * @depends testSearchItems
     */
    public function testInterfacesMappings(ItemInterface $item)
    {
        $this->assertInstanceOf('Sellsy\Tests\Fixtures\NewItem', $item);
    }
}
