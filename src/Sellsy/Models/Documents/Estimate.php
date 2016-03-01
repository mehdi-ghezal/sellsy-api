<?php

namespace Sellsy\Models\Documents;

/**
 * Class Estimate
 * @package Sellsy\Models\Documents
 */
class Estimate extends Document implements EstimateInterface
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
     * @copy expireDate
     */
    public $expireAt;
}