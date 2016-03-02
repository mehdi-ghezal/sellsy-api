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
     */
    protected $width;

    /**
     * @var string
     */
    protected $deepth;

    /**
     * @var string
     */
    protected $length;

    /**
     * @var string
     */
    protected $height;

    /**
     * @var string
     */
    protected $weight;

    /**
     * @var string
     */
    protected $packing;

    /**
     * @inheritdoc
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @inheritdoc
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @inheritdoc
     */
    public function getDeepth()
    {
        return $this->deepth;
    }

    /**
     * @inheritdoc
     */
    public function setDeepth($deepth)
    {
        $this->deepth = $deepth;
    }

    /**
     * @inheritdoc
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @inheritdoc
     */
    public function setLength($length)
    {
        $this->length = $length;
    }

    /**
     * @inheritdoc
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @inheritdoc
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @inheritdoc
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @inheritdoc
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * @inheritdoc
     */
    public function getPacking()
    {
        return $this->packing;
    }

    /**
     * @inheritdoc
     */
    public function setPacking($packing)
    {
        $this->packing = $packing;
    }
}