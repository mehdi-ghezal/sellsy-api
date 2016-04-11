<?php

namespace Sellsy\Models\Documents\Document;

/**
 * Class Row
 *
 * @package Sellsy\Models\Documents\Document
 */
class Row implements RowInterface
{
    /**
     * @var int rank
     */
    protected $position;

    /**
     * @var string type
     */
    protected $type;

    /**
     * @var string name
     */
    protected $label;

    /**
     * @var string notes
     */
    protected $description;

    /**
     * @var string defaultImage.file.public_path
     */
    protected $picture;

    /**
     * @var float qt
     */
    protected $quantity;

    /**
     * @var string unitText
     */
    protected $unit;

    /**
     * @var float unitAmount
     */
    protected $unitAmount;

    /**
     * @var float taxrate
     */
    protected $taxRate;

    /**
     * @var float taxAmount
     */
    protected $taxAmount;

    /**
     * @var float purchaseAmount
     */
    protected $unitPurchaseAmount;

    /**
     * @var float tauxMarque
     */
    protected $markupRate;

    /**
     * @var float tauxMarge
     */
    protected $marginRate;

    /**
     * @var string accountingCode
     */
    protected $accountingCode;

    /**
     * @inheritdoc
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @inheritdoc
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @inheritdoc
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @inheritdoc
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @inheritdoc
     */
    public function setLabel($label)
    {
        $this->label = $label;
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
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @inheritdoc
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
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
    public function getUnitAmount()
    {
        return $this->unitAmount;
    }

    /**
     * @inheritdoc
     */
    public function setUnitAmount($unitAmount)
    {
        $this->unitAmount = $unitAmount;
    }

    /**
     * @inheritdoc
     */
    public function getTaxRate()
    {
        return $this->taxRate;
    }

    /**
     * @inheritdoc
     */
    public function setTaxRate($taxRate)
    {
        $this->taxRate = $taxRate;
    }

    /**
     * @inheritdoc
     */
    public function getTaxAmount()
    {
        return $this->taxAmount;
    }

    /**
     * @inheritdoc
     */
    public function setTaxAmount($taxAmount)
    {
        $this->taxAmount = $taxAmount;
    }

    /**
     * @inheritdoc
     */
    public function getUnitPurchaseAmount()
    {
        return $this->unitPurchaseAmount;
    }

    /**
     * @inheritdoc
     */
    public function setUnitPurchaseAmount($unitPurchaseAmount)
    {
        $this->unitPurchaseAmount = $unitPurchaseAmount;
    }

    /**
     * @inheritdoc
     */
    public function getMarkupRate()
    {
        return $this->markupRate;
    }

    /**
     * @inheritdoc
     */
    public function setMarkupRate($markupRate)
    {
        $this->markupRate = $markupRate;
    }

    /**
     * @inheritdoc
     */
    public function getMarginRate()
    {
        return $this->marginRate;
    }

    /**
     * @inheritdoc
     */
    public function setMarginRate($marginRate)
    {
        $this->marginRate = $marginRate;
    }

    /**
     * @inheritdoc
     */
    public function getAccountingCode()
    {
        return $this->accountingCode;
    }

    /**
     * @inheritdoc
     */
    public function setAccountingCode($accountingCode)
    {
        $this->accountingCode = $accountingCode;
    }
}