<?php

namespace Sellsy\Models\CustomFields;

/**
 * Interface CustomFieldTraitInterface
 *
 * @package Sellsy\Models\CustomFields
 */
interface CustomFieldTraitInterface
{
    /**
     * @return CustomFieldInterface[]
     */
    public function getCustomFields();

    /**
     * @param \Closure $closure
     * @return null|CustomFieldInterface
     */
    public function getCustomField(\Closure $closure);

    /**
     * @param CustomFieldInterface[] $customFields
     */
    public function setCustomFields(array $customFields);

    /**
     * @param CustomFieldInterface $customField
     */
    public function addCustomFields($customField);
}