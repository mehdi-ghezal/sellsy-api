<?php

namespace Sellsy\Models\Documents;

/**
 * Class Order
 * @package Sellsy\Models\Documents
 */
class Order extends Document
{
    /**
     * @var \DateTime
     * @copy
     * @convert date
     */
    public $expireDate;
}