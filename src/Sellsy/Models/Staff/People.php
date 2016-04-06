<?php

namespace Sellsy\Models\Staff;

/**
 * Class People
 *
 * @package Sellsy\Models\Staff
 */
class People implements PeopleInterface
{
    /**
     * @var int
     */
    protected $id;

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
    protected $fullName;

    /**
     * @var \DateTime
     */
    protected $createAt;

    /**
     * @var \DateTime
     */
    protected $updateAt;

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
    protected $picture;

    /**
     * @var string
     */
    protected $avatar;

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
    public function getFullName()
    {
        if ($this->fullName) {
            return $this->fullName;
        }

        return sprintf('%s %s', $this->firstName, $this->lastName);
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
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * @inheritdoc
     */
    public function setCreateAt(\DateTime $createAt)
    {
        $this->createAt = $createAt;
    }

    /**
     * @inheritdoc
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * @inheritdoc
     */
    public function setUpdateAt(\DateTime $updateAt)
    {
        $this->updateAt = $updateAt;
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
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @inheritdoc
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }
}