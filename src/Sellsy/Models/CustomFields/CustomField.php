<?php

namespace Sellsy\Models\CustomFields;

/**
 * Class CustomField
 *
 * @package Sellsy\Models\CustomFields
 */
class CustomField implements CustomFieldInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $fieldId;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $textValue;

    /**
     * @var bool
     */
    protected $boolValue;

    /**
     * @var int
     */
    protected $timestampValue;

    /**
     * @var float
     */
    protected $decimalValue;

    /**
     * @var int
     */
    protected $numericValue;

    /**
     * @var string
     */
    protected $stringValue;

    /**
     * @var string
     */
    protected $formattedValue;

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
    public function getFieldId()
    {
        return $this->fieldId;
    }

    /**
     * @inheritdoc
     */
    public function setFieldId($fieldId)
    {
        $this->fieldId = $fieldId;
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
    public function getTextValue()
    {
        return $this->textValue;
    }

    /**
     * @inheritdoc
     */
    public function setTextValue($textValue)
    {
        $this->textValue = $textValue;
    }

    /**
     * @inheritdoc
     */
    public function isBoolValue()
    {
        return $this->boolValue;
    }

    /**
     * @inheritdoc
     */
    public function setBoolValue($boolValue)
    {
        $this->boolValue = $boolValue;
    }

    /**
     * @inheritdoc
     */
    public function getTimestampValue()
    {
        return $this->timestampValue;
    }

    /**
     * @inheritdoc
     */
    public function setTimestampValue($timestampValue)
    {
        $this->timestampValue = $timestampValue;
    }

    /**
     * @return float
     */
    public function getDecimalValue()
    {
        return $this->decimalValue;
    }

    /**
     * @inheritdoc
     */
    public function setDecimalValue($decimalValue)
    {
        $this->decimalValue = $decimalValue;
    }

    /**
     * @inheritdoc
     */
    public function getNumericValue()
    {
        return $this->numericValue;
    }

    /**
     * @inheritdoc
     */
    public function setNumericValue($numericValue)
    {
        $this->numericValue = $numericValue;
    }

    /**
     * @inheritdoc
     */
    public function getStringValue()
    {
        return $this->stringValue;
    }

    /**
     * @inheritdoc
     */
    public function setStringValue($stringValue)
    {
        $this->stringValue = $stringValue;
    }

    /**
     * @inheritdoc
     */
    public function getFormattedValue()
    {
        return $this->formattedValue;
    }

    /**
     * @inheritdoc
     */
    public function setFormattedValue($formattedValue)
    {
        $this->formattedValue = $formattedValue;
    }
}