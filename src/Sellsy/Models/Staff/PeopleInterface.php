<?php

namespace Sellsy\Models\Staff;

/**
 * Interface PeopleInterface
 *
 * @package Sellsy\Models\Staff
 */
interface PeopleInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getFirstName();

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName);

    /**
     * @return string
     */
    public function getLastName();

    /**
     * @param string $lastName
     */
    public function setLastName($lastName);

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param string $email
     */
    public function setEmail($email);

    /**
     * @return string
     */
    public function getFullName();

    /**
     * @param string $fullName
     */
    public function setFullName($fullName);

    /**
     * @return \DateTime
     */
    public function getCreateAt();

    /**
     * @param \DateTime $createAt
     */
    public function setCreateAt(\DateTime $createAt);

    /**
     * @return \DateTime
     */
    public function getUpdateAt();

    /**
     * @param \DateTime $updateAt
     */
    public function setUpdateAt(\DateTime $updateAt);

    /**
     * @return string
     */
    public function getPhoneNumber();

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber);

    /**
     * @return string
     */
    public function getMobileNumber();

    /**
     * @param string $mobileNumber
     */
    public function setMobileNumber($mobileNumber);

    /**
     * @return mixed
     */
    public function getPicture();

    /**
     * @param mixed $picture
     */
    public function setPicture($picture);

    /**
     * @return string
     */
    public function getAvatar();

    /**
     * @param string $avatar
     */
    public function setAvatar($avatar);
}