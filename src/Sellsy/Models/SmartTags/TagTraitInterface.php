<?php

namespace Sellsy\Models\SmartTags;

/**
 * Interface TagTraitInterface
 *
 * @package Sellsy\Models\SmartTags
 */
interface TagTraitInterface
{
    /**
     * @return TagInterface[]
     */
    public function getTags();

    /**
     * @param \Closure $closure
     * @return null|TagInterface
     */
    public function getTag(\Closure $closure);

    /**
     * @param string|null $name
     * @return boolean
     */
    public function hasTag($name = null);

    /**
     * @param TagInterface[] $tags
     */
    public function setTags(array $tags);

    /**
     * @param TagInterface $tag
     */
    public function addTag($tag);
}