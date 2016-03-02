<?php

namespace Sellsy\Models\Documents;

use Sellsy\Models\CustomFields\CustomFieldTrait;
use Sellsy\Models\SmartTags\TagTrait;

/**
 * Class Document
 * @package Sellsy\Models\Documents
 */
class Document implements DocumentInterface
{
    use CustomFieldTrait;
    use TagTrait;

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
     * @copy
     */
    public $note;

    /**
     * @var \DateTime
     * @copy created
     */
    public $createAt;

    /**
     * @var \DateTime
     * @copy displayedDate
     */
    public $displayDate;

    /**
     * @var string
     * @copy
     */
    public $analyticsCode;

    /**
     * @var float
     * @copy totalAmountTaxesFree
     */
    public $amountWithoutTax;

    /**
     * @var float
     * @copy taxesAmountSum
     */
    public $taxAmount;

    /**
     * @var float
     * @copy
     */
    public $packagingsAmount;

    /**
     * @var float
     * @copy
     */
    public $shippingsAmount;

    /**
     * @var float
     * @copy
     */
    public $discountPercent;

    /**
     * @var float
     * @copy
     */
    public $discountAmount;

    /**
     * @var \Sellsy\Models\Documents\Document\StepInterface
     * @copy {
     *      "step_id" : "id",
     *      "step": "name",
     *      "step_label": "label"
     * }
     */
    public $step;

    /**
     * @var \Sellsy\Models\Staff\PeopleInterface
     * @copy {
     *      "ownerid" : "id",
     *      "ownerFullName": "fullName"
     * }
     */
    public $owner;

    /**
     * @var \Sellsy\Models\Accounting\CurrencyInterface
     * @copy {
     *      "currencyid" : "id",
     *      "currencysymbol": "symbol"
     * }
     */
    public $currency;

    /**
     * @var \Sellsy\Models\Client\CustomerInterface
     * @copy {
     *      "thirdid" : "id",
     *      "thirdname": "name",
     *      "thirdemail": "email",
     *      "thirdtel": "phoneNumber",
     *      "thirdmobile": "mobileNumber"
     * }
     */
    public $customer;

    /**
     * @var \Sellsy\Models\Client\ContactInterface
     * @copy {
     *      "contactId" : "id",
     *      "contactName": "fullName"
     * }
     */
    public $contact;
}