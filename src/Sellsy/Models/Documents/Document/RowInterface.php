<?php

namespace Sellsy\Models\Documents\Document;

/**
 * Class Row
 *
 * @package Sellsy\Models\Documents\Document
 */
interface RowInterface
{
    /**
     * @return int
     */
    public function getPosition();

    /**
     * @param int $position
     */
    public function setPosition($position);

    /**
     * @return string
     */
    public function getType();

    /**
     * @param string $type
     */
    public function setType($type);

    /**
     * @return string
     */
    public function getLabel();

    /**
     * @param string $label
     */
    public function setLabel($label);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $description
     */
    public function setDescription($description);

    /**
     * @return string
     */
    public function getPicture();

    /**
     * @param string $picture
     */
    public function setPicture($picture);

    /**
     * @return float
     */
    public function getQuantity();

    /**
     * @param float $quantity
     */
    public function setQuantity($quantity);

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
    public function getUnitAmount();

    /**
     * @param float $unitAmount
     */
    public function setUnitAmount($unitAmount);

    /**
     * @return float
     */
    public function getTaxRate();

    /**
     * @param float $taxRate
     */
    public function setTaxRate($taxRate);

    /**
     * @return float
     */
    public function getTaxAmount();

    /**
     * @param float $taxAmount
     */
    public function setTaxAmount($taxAmount);

    /**
     * @return float
     */
    public function getUnitPurchaseAmount();

    /**
     * @param float $unitPurchaseAmount
     */
    public function setUnitPurchaseAmount($unitPurchaseAmount);

    /**
     * @return float
     */
    public function getMarkupRate();

    /**
     * @param float $markupRate
     */
    public function setMarkupRate($markupRate);

    /**
     * @return float
     */
    public function getMarginRate();

    /**
     * @param float $marginRate
     */
    public function setMarginRate($marginRate);

    /**
     * @return string
     */
    public function getAccountingCode();

    /**
     * @param string $accountingCode
     */
    public function setAccountingCode($accountingCode);
}