<?php

namespace Sellsy\Criteria\Catalogue;

use Sellsy\Criteria\Generic\GetListCriteria;

/**
 * Class ItemsSearchCriteria
 * @package Sellsy\Criteria\Catalogue
 */
class ItemsSearchCriteria extends GetListCriteria
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