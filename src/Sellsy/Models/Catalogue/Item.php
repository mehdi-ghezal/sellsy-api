<?php

namespace Sellsy\Models\Catalogue;

use Sellsy\Models\Catalogue\Item\PackagingInterface;
use Sellsy\Models\CustomFields\CustomFieldTrait;
use Sellsy\Models\SmartTags\TagTrait;

/**
 * Class Item
 *
 * @package Sellsy\Models\Catalogue
 */
class Item implements ItemInterface
{
    use CustomFieldTrait;
    use TagTrait;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var boolean
     */
    protected $isActive;

    /**
     * @var string
     */
    protected $analyticsCode;

    /**
     * @var boolean
     */
    protected $isEnabled;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var string
     */
    protected $tradename;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var float
     */
    protected $saleUnitAmountWithoutTax;

    /**
     * @var float
     */
    protected $saleUnitTaxAmount;

    /**
     * @var float
     */
    protected $purchaseUnitAmountWithoutTax;

    /**
     * @var float
     */
    protected $purchaseUnitTaxAmount;

    /**
     * @var string
     */
    protected $unit;

    /**
     * @var float
     */
    protected $quantity;

    /**
     * @var \DateTime
     */
    protected $createAt;

    /**
     * @var \DateTime
     */
    protected $updateAt;

    /**
     * @var string
     */
    protected $image;

    /**
     * @var PackagingInterface
     */
    protected $packaging;

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @inheritdoc
     */
    public function isActive()
    {
        return $this->isActive;
    }

    /**
     * @inheritdoc
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @inheritdoc
     */
    public function getAnalyticsCode()
    {
        return $this->analyticsCode;
    }

    /**
     * @inheritdoc
     */
    public function setAnalyticsCode($analyticsCode)
    {
        $this->analyticsCode = $analyticsCode;
    }

    /**
     * @inheritdoc
     */
    public function isEnabled()
    {
        return $this->isEnabled;
    }

    /**
     * @inheritdoc
     */
    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @inheritdoc
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @inheritdoc
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @inheritdoc
     */
    public function getTradename()
    {
        return $this->tradename;
    }

    /**
     * @inheritdoc
     */
    public function setTradename($tradename)
    {
        $this->tradename = $tradename;
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @inheritdoc
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @inheritdoc
     */
    public function getSaleUnitAmountWithoutTax()
    {
        return $this->saleUnitAmountWithoutTax;
    }

    /**
     * @inheritdoc
     */
    public function setSaleUnitAmountWithoutTax($saleUnitAmountWithoutTax)
    {
        $this->saleUnitAmountWithoutTax = $saleUnitAmountWithoutTax;
    }

    /**
     * @inheritdoc
     */
    public function getSaleUnitTaxAmount()
    {
        return $this->saleUnitTaxAmount;
    }

    /**
     * @inheritdoc
     */
    public function setSaleUnitTaxAmount($saleUnitTaxAmount)
    {
        $this->saleUnitTaxAmount = $saleUnitTaxAmount;
    }

    /**
     * @inheritdoc
     */
    public function getPurchaseUnitAmountWithoutTax()
    {
        return $this->purchaseUnitAmountWithoutTax;
    }

    /**
     * @inheritdoc
     */
    public function setPurchaseUnitAmountWithoutTax($purchaseUnitAmountWithoutTax)
    {
        $this->purchaseUnitAmountWithoutTax = $purchaseUnitAmountWithoutTax;
    }

    /**
     * @inheritdoc
     */
    public function getPurchaseUnitTaxAmount()
    {
        return $this->purchaseUnitTaxAmount;
    }

    /**
     * @inheritdoc
     */
    public function setPurchaseUnitTaxAmount($purchaseUnitTaxAmount)
    {
        $this->purchaseUnitTaxAmount = $purchaseUnitTaxAmount;
    }

    /**
     * @inheritdoc
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @inheritdoc
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
    }

    /**
     * @inheritdoc
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @inheritdoc
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @inheritdoc
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * @inheritdoc
     */
    public function setCreateAt(\DateTime $createAt)
    {
        $this->createAt = $createAt;
    }

    /**
     * @inheritdoc
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * @inheritdoc
     */
    public function setUpdateAt(\DateTime $updateAt)
    {
        $this->updateAt = $updateAt;
    }

    /**
     * @inheritdoc
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @inheritdoc
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @inheritdoc
     */
    public function getPackaging()
    {
        return $this->packaging;
    }

    /**
     * @inheritdoc
     */
    public function setPackaging(PackagingInterface $packaging)
    {
        $this->packaging = $packaging;
    }
}