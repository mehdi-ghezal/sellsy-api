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
     * @var TagInterface[]
     */
    protected $tags;

    /**
     * @return TagInterface[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param \Closure $closure
     * @return null|TagInterface
     */
    public function getTag(\Closure $closure)
    {
        foreach($this->tags as $tag) {
            if ($closure($tag)) {
                return $tag;
            }
        }

        return null;
    }

    /**
     * @param string|null $name
     * @return boolean
     */
    public function hasTag($name = null)
    {
        if (! $name) {
            return !! $this->getTags();
        }

        $tagFound = $this->getTag(function(TagInterface $tag) use($name) {
            return $tag->getName() == $name;
        });

        return $tagFound !== null;
    }

    /**
     * @param TagInterface[] $tags
     */
    public function setTags(array $tags)
    {
        $this->tags = $tags;
    }

    /**
     * @param TagInterface $tag
     */
    public function addTag($tag)
    {
        if (! $this->tags) {
            $this->tags = array();
        }

        $this->tags[] = $tag;
    }
}