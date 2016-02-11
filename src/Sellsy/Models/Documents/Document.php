<?php

namespace Sellsy\Models\Documents;

use Sellsy\Models\CustomFields\CustomFieldTrait;

/**
 * Class Document
 * @package Sellsy\Models\Documents
 */
class Document
{
    use CustomFieldTrait;

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
     * @convert date
     */
    public $createdDate;

    /**
     * @var \DateTime
     * @copy displayedDate
     * @convert date
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
    public $amountWithoutTaxes;

    /**
     * @var float
     * @copy taxesAmountSum
     */
    public $taxes;

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
     * @var \Sellsy\Models\Documents\Document\Step
     * @copy {
     *      "step_id" : "id",
     *      "step": "name",
     *      "step_label": "label"
     * }
     */
    public $step;

    /**
     * @var \Sellsy\Models\SmartTags\Tag[]
     * @copy {
     *      "tags": {
     *          "id" : "id",
     *          "word": "word",
     *          "category": "category"
     *      }
     * }
     */
    public $tags;

    /**
     * @var \Sellsy\Models\Staff\People
     * @copy {
     *      "ownerid" : "id",
     *      "ownerFullName": "fullName"
     * }
     */
    public $owner;

    /**
     * @var \Sellsy\Models\Accounting\Currency
     * @copy {
     *      "currencyid" : "id",
     *      "currencysymbol": "symbol"
     * }
     */
    public $currency;

    /**
     * @var \Sellsy\Models\Client\Customer
     * @copy {
     *      "thirdid" : "id",
     *      "thirdname": "name",
     *      "thirdemail": "email",
     *      "thirdtel": "phoneNumber"
     *      "thirdmobile": "mobileNumber"
     * }
     */
    public $customer;

    /**
     * @var \Sellsy\Models\Client\Contact
     * @copy {
     *      "contactId" : "id",
     *      "contactName": "fullName"
     * }
     */
    public $contact;
}