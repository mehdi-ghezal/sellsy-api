<?php

namespace Sellsy\Criteria\Generic;

use Sellsy\Criteria\CriteriaInterface;

/**
 * Class GetOneCriteria
 *
 * @package Sellsy\Criteria\Generic
 */
abstract class GetOneCriteria implements CriteriaInterface
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