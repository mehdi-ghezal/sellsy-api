<?php

namespace Sellsy\Criteria\Generic;

use Sellsy\Criteria\CriteriaInterface;

/**
 * Class GetListCriteria
 * @package Sellsy\Criteria\Generic
 */
abstract class GetListCriteria implements CriteriaInterface
{
    /**
     * @var array
     */
    protected $tags;

    /**
     * @param string $tag
     * @return $this
     */
    public function addTag($tag)
    {
        $this->tags[] = $tag;
        return $this;
    }

    /**
     * @param array $tags
     * @return $this
     */
    public function setTags(array $tags)
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return $this
     */
    public function clearTags()
    {
        $this->tags = array();
        return $this;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }
}