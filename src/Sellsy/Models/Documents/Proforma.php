<?php

namespace Sellsy\Models\Documents;

/**
 * Class Proforma
 * @package Sellsy\Models\Documents
 */
class Proforma extends Document
{
    /**
     * @var \DateTime
     * @copy expireDate
     * @convert date
     */
    public $expireAt;
}