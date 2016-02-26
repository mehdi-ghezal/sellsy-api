<?php

namespace Sellsy\Models\Client;

/**
 * Class Customer
 * @package Sellsy\Models\Customer
 */
class Customer implements CustomerInterface
{
    /**
     * @var int
     * @copy
     */
    public $id;

    /**
     * @var string
     * @copy
     */
    public $name;

    /**
     * @var string
     * @copy
     */
    public $email;

    /**
     * @var string
     * @copy
     */
    public $phoneNumber;

    /**
     * @var string
     * @copy
     */
    public $mobileNumber;
}