<?php

namespace Sellsy\Models\SmartTags;

/**
 * Class Tag
 * @package Sellsy\Models\SmartTags
 */
class Tag implements TagInterface
{
    /**
     * @var int
     * @copy
     */
    public $id;

    /**
     * @var string
     * @copy word
     */
    public $name;

    /**
     * @var string
     * @copy
     */
    public $category;
}