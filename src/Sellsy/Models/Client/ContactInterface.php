<?php

namespace Sellsy\Models\Client;

/**
 * Class Contact
 *
 * @package Sellsy\Models\Client
 */
interface ContactInterface
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
    public function getFullName();

    /**
     * @param string $fullName
     */
    public function setFullName($fullName);

    /**
     * @return string
     */
    public function getPicture();

    /**
     * @param string $picture
     */
    public function setPicture($picture);

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
     * @return string
     */
    public function getFax();

    /**
     * @param string $fax
     */
    public function setFax($fax);
}