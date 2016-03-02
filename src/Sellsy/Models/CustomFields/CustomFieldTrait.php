<?php

namespace Sellsy\Models\CustomFields;

/**
 * Class CustomFieldTrait
 *
 * @package Sellsy\Models\CustomFields
 */
trait CustomFieldTrait
{
    /**
     * @var CustomFieldInterface[]
     */
    protected $customFields;

    /**
     * @return CustomFieldInterface[]
     */
    public function getCustomFields()
    {
        return $this->customFields;
    }

    /**
     * @param \Closure $closure
     * @return null|CustomFieldInterface
     */
    public function getCustomField(\Closure $closure)
    {
        foreach($this->customFields as $customField) {
            if ($closure($customField)) {
                return $customField;
            }
        }

        return null;
    }

    /**
     * @param CustomFieldInterface[] $customFields
     */
    public function setCustomFields(array $customFields)
    {
        $this->customFields = $customFields;
    }

    /**
     * @param CustomFieldInterface $customField
     */
    public function addCustomFields($customField)
    {
        if (! $this->customFields) {
            $this->customFields = array();
        }

        $this->customFields[] = $customField;
    }
}