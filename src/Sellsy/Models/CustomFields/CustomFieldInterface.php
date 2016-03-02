<?php

namespace Sellsy\Models\CustomFields;

/**
 * Interface CustomFieldInterface
 *
 * @package Sellsy\Models\CustomFields
 */
interface CustomFieldInterface
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
     * @return int
     */
    public function getFieldId();

    /**
     * @param int $fieldId
     */
    public function setFieldId($fieldId);

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
    public function getTextValue();

    /**
     * @param string $textValue
     */
    public function setTextValue($textValue);

    /**
     * @return boolean
     */
    public function isBoolValue();

    /**
     * @param boolean $boolValue
     */
    public function setBoolValue($boolValue);

    /**
     * @return int
     */
    public function getTimestampValue();

    /**
     * @param int $timestampValue
     */
    public function setTimestampValue($timestampValue);

    /**
     * @return float
     */
    public function getDecimalValue();

    /**
     * @param float $decimalValue
     */
    public function setDecimalValue($decimalValue);

    /**
     * @return int
     */
    public function getNumericValue();

    /**
     * @param int $numericValue
     */
    public function setNumericValue($numericValue);

    /**
     * @return string
     */
    public function getStringValue();

    /**
     * @param string $stringValue
     */
    public function setStringValue($stringValue);

    /**
     * @return string
     */
    public function getFormattedValue();

    /**
     * @param string $formattedValue
     */
    public function setFormattedValue($formattedValue);
}