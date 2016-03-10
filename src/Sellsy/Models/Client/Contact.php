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
    protected $picture;

    /**
     * @var string
     */
    protected $fullName;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $phoneNumber;

    /**
     * @var string
     */
    protected $mobileNumber;

    /**
     * @var string
     */
    protected $fax;

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

    /**
     * @inheritdoc
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @inheritdoc
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @inheritdoc
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @inheritdoc
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @inheritdoc
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @inheritdoc
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @inheritdoc
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @inheritdoc
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @inheritdoc
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @inheritdoc
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @inheritdoc
     */
    public function getMobileNumber()
    {
        return $this->mobileNumber;
    }

    /**
     * @inheritdoc
     */
    public function setMobileNumber($mobileNumber)
    {
        $this->mobileNumber = $mobileNumber;
    }

    /**
     * @inheritdoc
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @inheritdoc
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }
}