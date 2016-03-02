<?php

namespace Sellsy\Models\Client;

/**
 * Class Contact
 *
 * @package Sellsy\Models\Client
 */
class Contact implements ContactInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $fullName;

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @inheritdoc
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @inheritdoc
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }
}