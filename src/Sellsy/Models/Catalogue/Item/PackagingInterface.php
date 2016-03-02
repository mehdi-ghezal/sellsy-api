<?php

namespace Sellsy\Models\Catalogue\Item;

/**
 * Class Packaging
 *
 * @package Sellsy\Models\Catalogue\Item
 */
interface PackagingInterface
{
    /**
     * @return string
     */
    public function getWidth();

    /**
     * @param string $width
     */
    public function setWidth($width);

    /**
     * @return string
     */
    public function getDeepth();

    /**
     * @param string $deepth
     */
    public function setDeepth($deepth);

    /**
     * @return string
     */
    public function getLength();

    /**
     * @param string $length
     */
    public function setLength($length);

    /**
     * @return string
     */
    public function getHeight();

    /**
     * @param string $height
     */
    public function setHeight($height);

    /**
     * @return string
     */
    public function getWeight();

    /**
     * @param string $weight
     */
    public function setWeight($weight);

    /**
     * @return string
     */
    public function getPacking();

    /**
     * @param string $packing
     */
    public function setPacking($packing);
}