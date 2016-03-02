<?php

namespace Sellsy\Models\Client;

/**
 * Class Customer
 *
 * @package Sellsy\Models\Client
 */
interface CustomerInterface
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
    public function getName();

    /**
     * @param string $name
     */
    public function setName($name);

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
}