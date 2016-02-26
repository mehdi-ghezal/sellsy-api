<?php

namespace Sellsy\Models\Client;

/**
 * Class Contact
 * @package Sellsy\Models\Client
 */
class Contact implements ContactInterface
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
    public $fullName;
}