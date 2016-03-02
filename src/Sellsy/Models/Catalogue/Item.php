<?php

namespace Sellsy\Models\Catalogue;

use Sellsy\Models\CustomFields\CustomFieldTrait;
use Sellsy\Models\SmartTags\TagTrait;

/**
 * Class Item
 * @package Sellsy\Models\Catalogue
 */
class Item implements ItemInterface
{
    use CustomFieldTrait;
    use TagTrait;

    /**
     * @var int
     * @copy
     */
    public $id;

    /**
     * @var boolean
     * @copy actif
     */
    public $isActive;

    /**
     * @var string
     * @copy
     */
    public $analyticsCode;

    /**
     * @var boolean
     * @copy
     */
    public $isEnabled;

    /**
     * @var string
     * @copy
     */
    public $name;

    /**
     * @var string
     * @copy
     */
    public $slug;

    /**
     * @var string
     * @copy
     */
    public $tradename;

    /**
     * @var string
     * @copy notes
     */
    public $description;

    /**
     * @var float
     * @copy unitAmount
     */
    public $saleUnitAmountWithoutTax;

    /**
     * @var float
     * @copy unitAmountTaxesInc - unitAmount
     */
    public $saleUnitTaxAmount;

    /**
     * @var float
     * @copy purchaseAmount
     */
    public $purchaseUnitAmountWithoutTax;

    /**
     * @var float
     * @copy purchaseAmountTaxesInc - purchaseAmount
     */
    public $purchaseUnitTaxAmount;

    /**
     * @var string
     * @copy
     */
    public $unit;

    /**
     * @var float
     * @copy qt
     */
    public $quantity;

    /**
     * @var \DateTime
     * @copy createdAt
     */
    public $createAt;

    /**
     * @var \DateTime
     * @copy updatedAt
     */
    public $updateAt;

    /**
     * @var string
     * @copy defaultImage.file.public_path
     */
    public $images;

    /**
     * @var \Sellsy\Models\Catalogue\Item\PackagingInterface
     * @copy {
     *      "characteristics.width" : "width",
     *      "characteristics.deepth": "deepth",
     *      "characteristics.length": "length",
     *      "characteristics.height": "height",
     *      "characteristics.weight": "weight",
     *      "characteristics.packing": "packing"
     * }
     */
    public $packaging;
}