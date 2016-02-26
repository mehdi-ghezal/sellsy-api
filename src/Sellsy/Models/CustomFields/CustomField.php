<?php

namespace Sellsy\Models\CustomFields;

/**
 * Class CustomField
 * @package Sellsy\Models\CustomFields
 */
class CustomField implements CustomFieldInterface
{
    /**
     * @var int
     * @copy
     */
    public $id;

    /**
     * @var int
     * @copy cfid
     */
    public $fieldId;

    /**
     * @var string
     * @copy
     */
    public $type;

    /**
     * @var string
     * @copy textval
     */
    public $textValue;

    /**
     * @var bool
     * @copy boolval
     */
    public $boolValue;

    /**
     * @var int
     * @copy timestampval
     */
    public $timestampValue;

    /**
     * @var float
     * @copy decimalval
     */
    public $decimalValue;

    /**
     * @var int
     * @copy numericval
     */
    public $numericValue;

    /**
     * @var string
     * @copy stringval
     */
    public $stringValue;

    /**
     * @var string
     * @copy formatted_value
     */
    public $formattedValue;
}