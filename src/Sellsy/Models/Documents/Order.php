<?php

namespace Sellsy\Models\Documents;

/**
 * Class Order
 * @package Sellsy\Models\Documents
 */
class Order extends Document implements OrderInterface
{
    /**
     * @var \DateTime
     * @copy expireDate
     * @convert date
     */
    public $expireAt;
}