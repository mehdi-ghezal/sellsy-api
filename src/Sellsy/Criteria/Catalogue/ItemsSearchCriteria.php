<?php

namespace Sellsy\Criteria\Catalogue;

use Sellsy\Interfaces\CriteriaInterface;

/**
 * Class ItemsSearchCriteria
 * @package Sellsy\Criteria\Catalogue
 */
class ItemsSearchCriteria implements CriteriaInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $category;

    /**
     * @var array
     */
    protected $tags;

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param int $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return int
     */
    public function getCategory()
    {
        return $this->category;
    }

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

    /**
     * @return array
     */
    public function getParameters()
    {
        // Initialize parameters
        $parameters = array(
            'type' => 'item',
            'search' => array()
        );

        // Setup parameters
        if ($this->name) {
            $parameters['search']['name'] = $this->name;
        }

        if ($this->category) {
            $parameters['search']['categoryid'] = $this->category;
        }

        if ($this->tags) {
            $parameters['search']['tags'] = implode(',', $this->tags);
        }

        // Cleaning parameters
        if (! count($parameters['search'])) {
            unset($parameters['search']);
        }

        return $parameters;
    }
} 