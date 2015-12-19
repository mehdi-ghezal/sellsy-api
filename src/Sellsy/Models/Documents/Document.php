<?php

namespace Sellsy\Models\Documents;

use Sellsy\Models\Staff\People;

/**
 * Class Document
 * @package Sellsy\Models\Documents
 */
class Document
{
    /**
     * @var int
     * @copy
     */
    public $id;

    /**
     * @var string
     * @copy ident
     */
    public $reference;

    /**
     * @var string
     * @copy currencysymbol
     */
    public $currencySymbol;

    /**
     * @var \DateTime
     * @copy displayedDate
     * @convert date
     */
    public $displayDate;

    /**
     * @var float
     * @copy totalAmountTaxesFree
     * @convert float
     */
    public $amountWithoutTaxes;

    /**
     * @var float
     * @copy taxesAmountSum
     * @convert float
     */
    public $taxes;

    /**
     * @var float
     * @copy marge
     * @convert float
     */
    public $profitMargins;

    /**
     * @var float
     * @copy
     * @convert float
     */
    public $dueAmount;

    /**
     * @var People
     * @copy {
     *      "ownerid" : "id",
     *      "ownerFullName": "fullName"
     * }
     */
    public $owner;

    /**
     * Constructor : Initialize attributes
     */
    public function __construct()
    {
        $this->owner = new People();
    }
} 