<?php

namespace Sellsy\Models\CustomFields;

/**
 * Class CustomFieldTrait
 * @package Sellsy\Models\CustomFields
 */
trait CustomFieldTrait
{
    /**
     * @var \Sellsy\Models\CustomFields\CustomField[]
     * @copy {
     *      "customfields": {
     *          "id": "id",
     *          "cfid": "cfid",
     *          "type": "type",
     *          "textval": "textval",
     *          "boolval": "boolval",
     *          "timestampval": "timestampval",
     *          "decimalval": "decimalval",
     *          "numericval": "numericval",
     *          "stringval": "stringval",
     *          "formatted_value": "formatted_value"
     *      }
     * }
     */
    public $customFields;
}