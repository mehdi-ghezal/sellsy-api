<?php

namespace Sellsy\Models\Documents;

/**
 * Class Invoice
 * @package Sellsy\Models\Documents
 */
class Invoice extends Document
{
    /**
     * @var float
     * @copy
     */
    public $dueAmount;

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
}