<?php

namespace Sellsy\Clients\Catalogue;

use Sellsy\Interfaces\CriteriaInterface;

/**
 * Class ItemsSearchCriteria
 * @package Sellsy\Clients\Catalogue
 */
class ItemsSearchCriteria implements CriteriaInterface
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var array
     */
    protected $tags;

    /**
     * @var int
     */
    public $category;

    /**
     * @param $tag
     * @return $this
     */
    public function addTag($tag)
    {
        $this->tags[] = $tag;
        return $this;
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