<?php

namespace Sellsy\Models\SmartTags;

/**
 * Class TagTrait
 *
 * @package Sellsy\Models\SmartTags
 */
trait TagTrait
{
    /**
     * @var \Sellsy\Models\SmartTags\TagInterface[]
     * @copy {
     *      "tags": {
     *          "id" : "id",
     *          "word": "word",
     *          "category": "category"
     *      }
     * }
     */
    public $tags;
}