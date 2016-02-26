<?php

namespace Sellsy\Models\Documents\Document;

/**
 * Class Step
 * @package Sellsy\Models\Documents\Document
 */
class Step implements StepInterface
{
    /**
     * @var int
     * @copy
     */
    public $id;

    /**
     * @var string
     * @copy
     */
    public $name;

    /**
     * @var string
     * @copy
     */
    public $label;
} 