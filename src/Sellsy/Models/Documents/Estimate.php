<?php

namespace Sellsy\Models\Documents;

/**
 * Class Estimate
 * @package Sellsy\Models\Documents
 */
class Estimate extends Document
{
    /**
     * @var float
     * @copy marge
     */
    public $marginAmount;

    /**
     * @var float
     * @copy marge_tauxMarge
     */
    public $marginRate;

    /**
     * @var float
     * @copy marge_tauxMarque
     */
    public $markupRate;

    /**
     * @var \DateTime
     * @copy
     * @convert date
     */
    public $expireDate;
}