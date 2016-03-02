<?php

namespace Sellsy\Models\Documents\Document;

/**
 * Interface StepInterface
 *
 * @package Sellsy\Models\Documents\Document
 */
interface StepInterface
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
    public function getLabel();

    /**
     * @param string $label
     */
    public function setLabel($label);
}