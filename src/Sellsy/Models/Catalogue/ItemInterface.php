<?php

namespace Sellsy\Models\Catalogue;

use Sellsy\Models\Catalogue\Item\PackagingInterface;
use Sellsy\Models\CustomFields\CustomFieldTraitInterface;
use Sellsy\Models\SmartTags\TagTraitInterface;

/**
 * Class Item
 *
 * @package Sellsy\Models\Catalogue
 */
interface ItemInterface extends TagTraitInterface, CustomFieldTraitInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     */
    public function setId($id);

    /**
     * @return boolean
     */
    public function isActive();

    /**
     * @param boolean $isActive
     */
    public function setIsActive($isActive);

    /**
     * @return string
     */
    public function getAnalyticsCode();

    /**
     * @param string $analyticsCode
     */
    public function setAnalyticsCode($analyticsCode);

    /**
     * @return boolean
     */
    public function isEnabled();

    /**
     * @param boolean $isEnabled
     */
    public function setIsEnabled($isEnabled);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getSlug();

    /**
     * @param string $slug
     */
    public function setSlug($slug);

    /**
     * @return string
     */
    public function getTradename();

    /**
     * @param string $tradename
     */
    public function setTradename($tradename);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $description
     */
    public function setDescription($description);

    /**
     * @return float
     */
    public function getSaleUnitAmountWithoutTax();

    /**
     * @param float $saleUnitAmountWithoutTax
     */
    public function setSaleUnitAmountWithoutTax($saleUnitAmountWithoutTax);

    /**
     * @return float
     */
    public function getSaleUnitTaxAmount();

    /**
     * @param float $saleUnitTaxAmount
     */
    public function setSaleUnitTaxAmount($saleUnitTaxAmount);

    /**
     * @return float
     */
    public function getPurchaseUnitAmountWithoutTax();

    /**
     * @param float $purchaseUnitAmountWithoutTax
     */
    public function setPurchaseUnitAmountWithoutTax($purchaseUnitAmountWithoutTax);

    /**
     * @return float
     */
    public function getPurchaseUnitTaxAmount();

    /**
     * @param float $purchaseUnitTaxAmount
     */
    public function setPurchaseUnitTaxAmount($purchaseUnitTaxAmount);

    /**
     * @return string
     */
    public function getUnit();

    /**
     * @param string $unit
     */
    public function setUnit($unit);

    /**
     * @return float
     */
    public function getQuantity();

    /**
     * @param float $quantity
     */
    public function setQuantity($quantity);

    /**
     * @return \DateTime
     */
    public function getCreateAt();

    /**
     * @param \DateTime $createAt
     */
    public function setCreateAt(\DateTime $createAt);

    /**
     * @return \DateTime
     */
    public function getUpdateAt();

    /**
     * @param \DateTime $updateAt
     */
    public function setUpdateAt(\DateTime $updateAt);

    /**
     * @return string
     */
    public function getImage();

    /**
     * @param string $image
     */
    public function setImage($image);

    /**
     * @return PackagingInterface
     */
    public function getPackaging();

    /**
     * @param PackagingInterface $packaging
     */
    public function setPackaging(PackagingInterface $packaging);
}