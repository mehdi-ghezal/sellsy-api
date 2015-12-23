<?php

namespace Sellsy\Criteria\Generic;

use Sellsy\Interfaces\CriteriaInterface;

/**
 * Class GetOne
 * @package Sellsy\Criteria\Generic
 */
class GetOneCriteria implements CriteriaInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * GetOneCriteria constructor.
     *
     * @param int $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return array('id' => $this->id);
    }
}