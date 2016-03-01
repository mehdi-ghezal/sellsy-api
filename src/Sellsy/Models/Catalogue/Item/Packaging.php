<?php

namespace Sellsy\Models\Catalogue\Item;

/**
 * Class Packaging
 *
 * @package Sellsy\Models\Catalogue\Item
 */
class Packaging implements PackagingInterface
{
    /**
     * @var string
     * @copy
     */
    public $width;

    /**
     * @var string
     * @copy
     */
    public $deepth;

    /**
     * @var string
     * @copy
     */
    public $length;

    /**
     * @var string
     * @copy
     */
    public $height;

    /**
     * @var string
     * @copy
     */
    public $weight;

    /**
     * @var string
     * @copy
     */
    public $packing;
}