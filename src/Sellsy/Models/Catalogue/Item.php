<?php

namespace Sellsy\Models\Catalogue;

use Sellsy\Models\CustomFields\CustomFieldTrait;

/**
 * Class Item
 * @package Sellsy\Models\Catalogue
 */
class Item implements ItemInterface
{
    use CustomFieldTrait;

    /**
     * @var int
     * @copy
     */
    public $id;

    /**
     * @var boolean
     * @copy actif
     * @convert boolean
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
     * @convert boolean
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
     * @convert date
     */
    public $createAt;

    /**
     * @var \DateTime
     * @copy updatedAt
     * @convert date
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
     *      "characteristics": {
     *          "width" : "width",
     *          "deepth" : "deepth",
     *          "length" : "length",
     *          "height" : "height",
     *          "weight" : "weight",
     *          "packing" : "packing",
     *      }
     * }
     */
    public $packaging;
}