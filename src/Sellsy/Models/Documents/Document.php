<?php

namespace Sellsy\Models\Documents;

use Sellsy\Exception\RuntimeException;
use Sellsy\Models\Accounting\CurrencyInterface;
use Sellsy\Models\Client\ContactInterface;
use Sellsy\Models\Client\CustomerInterface;
use Sellsy\Models\CustomFields\CustomFieldTrait;
use Sellsy\Models\Documents\Document\StepInterface;
use Sellsy\Models\SmartTags\TagTrait;
use Sellsy\Models\Staff\PeopleInterface;

/**
 * Class Document
 *
 * @package Sellsy\Models\Documents
 */
class Document implements DocumentInterface
{
    use CustomFieldTrait;
    use TagTrait;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $reference;

    /**
     * @var string
     */
    protected $note;

    /**
     * @var \DateTime
     */
    protected $createAt;

    /**
     * @var \DateTime
     */
    protected $displayDate;

    /**
     * @var string
     */
    protected $analyticsCode;

    /**
     * @var float
     */
    protected $amountWithoutTax;

    /**
     * @var float
     */
    protected $taxAmount;

    /**
     * @var float
     */
    protected $packagingsAmount;

    /**
     * @var float
     */
    protected $shippingsAmount;

    /**
     * @var float
     */
    protected $discountPercent;

    /**
     * @var float
     */
    protected $discountAmount;

    /**
     * @var StepInterface
     */
     protected $step;

    /**
     * @var PeopleInterface
     */
    protected $owner;

    /**
     * @var CurrencyInterface
     */
    protected $currency;

    /**
     * @var CustomerInterface
     */
    protected $customer;

    /**
     * @var ContactInterface
     */
    protected $contact;

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @inheritdoc
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @inheritdoc
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @inheritdoc
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @inheritdoc
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @inheritdoc
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * @inheritdoc
     */
    public function setCreateAt(\DateTime $createAt)
    {
        $this->createAt = $createAt;
    }

    /**
     * @inheritdoc
     */
    public function getDisplayDate()
    {
        return $this->displayDate;
    }

    /**
     * @inheritdoc
     */
    public function setDisplayDate(\DateTime $displayDate)
    {
        $this->displayDate = $displayDate;
    }

    /**
     * @inheritdoc
     */
    public function getAnalyticsCode()
    {
        return $this->analyticsCode;
    }

    /**
     * @inheritdoc
     */
    public function setAnalyticsCode($analyticsCode)
    {
        $this->analyticsCode = $analyticsCode;
    }

    /**
     * @inheritdoc
     */
    public function getAmountWithoutTax()
    {
        return $this->amountWithoutTax;
    }

    /**
     * @inheritdoc
     */
    public function setAmountWithoutTax($amountWithoutTax)
    {
        $this->amountWithoutTax = $amountWithoutTax;
    }

    /**
     * @inheritdoc
     */
    public function getTaxAmount()
    {
        return $this->taxAmount;
    }

    /**
     * @inheritdoc
     */
    public function setTaxAmount($taxAmount)
    {
        $this->taxAmount = $taxAmount;
    }

    /**
     * @inheritdoc
     */
    public function getPackagingsAmount()
    {
        return $this->packagingsAmount;
    }

    /**
     * @inheritdoc
     */
    public function setPackagingsAmount($packagingsAmount)
    {
        $this->packagingsAmount = $packagingsAmount;
    }

    /**
     * @inheritdoc
     */
    public function getShippingsAmount()
    {
        return $this->shippingsAmount;
    }

    /**
     * @inheritdoc
     */
    public function setShippingsAmount($shippingsAmount)
    {
        $this->shippingsAmount = $shippingsAmount;
    }

    /**
     * @inheritdoc
     */
    public function getDiscountPercent()
    {
        return $this->discountPercent;
    }

    /**
     * @inheritdoc
     */
    public function setDiscountPercent($discountPercent)
    {
        $this->discountPercent = $discountPercent;
    }

    /**
     * @inheritdoc
     */
    public function getDiscountAmount()
    {
        return $this->discountAmount;
    }

    /**
     * @inheritdoc
     */
    public function setDiscountAmount($discountAmount)
    {
        $this->discountAmount = $discountAmount;
    }

    /**
     * @inheritdoc
     */
    public function getStep()
    {
        return $this->step;
    }

    /**
     * @inheritdoc
     */
    public function setStep(StepInterface $step)
    {
        $this->step = $step;
    }

    /**
     * @inheritdoc
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @inheritdoc
     */
    public function setOwner(PeopleInterface $owner)
    {
        $this->owner = $owner;
    }

    /**
     * @inheritdoc
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @inheritdoc
     */
    public function setCurrency(CurrencyInterface $currency)
    {
        $this->currency = $currency;
    }

    /**
     * @inheritdoc
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @inheritdoc
     */
    public function setCustomer(CustomerInterface $customer)
    {
        $this->customer = $customer;
    }

    /**
     * @inheritdoc
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @inheritdoc
     */
    public function setContact(ContactInterface $contact)
    {
        $this->contact = $contact;
    }

    /**
     * @inheritdoc
     */
    public function isDraft()
    {
        return $this->step->getName() == StepInterface::STEP_DRAFT;
    }

    /**
     * @inheritdoc
     */
    public function getDoctype()
    {
        if ($this instanceof DeliveryInterface) {
            return 'delivery';
        }

        if ($this instanceof EstimateInterface) {
            return 'estimate';
        }

        if ($this instanceof InvoiceInterface) {
            return 'invoice';
        }

        if ($this instanceof OrderInterface) {
            return 'order';
        }

        if ($this instanceof Proforma) {
            return 'proforma';
        }

        throw new RuntimeException(sprintf('Unable to find doctype for class "%s"', static::class));
    }
}