<?php

namespace Sellsy\Criteria\Generic;

use Sellsy\Criteria\CriteriaInterface;
use Sellsy\Models\SmartTags\TagInterface;

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
        if ($tag instanceof TagInterface) {
            $tag = $tag->getName();
        }

        $this->tags[] = $tag;
        return $this;
    }

    /**
     * @param array $tags
     * @return $this
     */
    public function setTags(array $tags)
    {
        $this->clearTags();

        foreach($tags as $tag) {
            $this->addTag($tag);
        }

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