<?php

namespace Sellsy\Models\Documents;

use Sellsy\Models\Accounting\CurrencyInterface;
use Sellsy\Models\Client\ContactInterface;
use Sellsy\Models\Client\CustomerInterface;
use Sellsy\Models\Documents\Document\StepInterface;
use Sellsy\Models\Staff\PeopleInterface;

/**
 * Interface DocumentInterface
 *
 * @package Sellsy\Models\Documents
 */
interface DocumentInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getReference();

    /**
     * @param string $reference
     */
    public function setReference($reference);

    /**
     * @return string
     */
    public function getNote();

    /**
     * @param string $note
     */
    public function setNote($note);

    /**
     * @return \DateTime
     */
    public function getCreateAt();

    /**
     * @param \DateTime $createAt
     */
    public function setCreateAt(\DateTime $createAt);

    /**
     * @return \DateTime
     */
    public function getDisplayDate();

    /**
     * @param \DateTime $displayDate
     */
    public function setDisplayDate(\DateTime $displayDate);

    /**
     * @return string
     */
    public function getAnalyticsCode();

    /**
     * @param string $analyticsCode
     */
    public function setAnalyticsCode($analyticsCode);

    /**
     * @return float
     */
    public function getAmountWithoutTax();

    /**
     * @param float $amountWithoutTax
     */
    public function setAmountWithoutTax($amountWithoutTax);

    /**
     * @return float
     */
    public function getTaxAmount();

    /**
     * @param float $taxAmount
     */
    public function setTaxAmount($taxAmount);

    /**
     * @return float
     */
    public function getPackagingsAmount();

    /**
     * @param float $packagingsAmount
     */
    public function setPackagingsAmount($packagingsAmount);

    /**
     * @return float
     */
    public function getShippingsAmount();

    /**
     * @param float $shippingsAmount
     */
    public function setShippingsAmount($shippingsAmount);

    /**
     * @return float
     */
    public function getDiscountPercent();

    /**
     * @param float $discountPercent
     */
    public function setDiscountPercent($discountPercent);

    /**
     * @return float
     */
    public function getDiscountAmount();

    /**
     * @param float $discountAmount
     */
    public function setDiscountAmount($discountAmount);

    /**
     * @return StepInterface
     */
    public function getStep();

    /**
     * @param StepInterface $step
     */
    public function setStep(StepInterface $step);

    /**
     * @return PeopleInterface
     */
    public function getOwner();

    /**
     * @param PeopleInterface $owner
     */
    public function setOwner(PeopleInterface $owner);

    /**
     * @return CurrencyInterface
     */
    public function getCurrency();

    /**
     * @param CurrencyInterface $currency
     */
    public function setCurrency(CurrencyInterface $currency);

    /**
     * @return CustomerInterface
     */
    public function getCustomer();

    /**
     * @param CustomerInterface $customer
     */
    public function setCustomer(CustomerInterface $customer);

    /**
     * @return ContactInterface
     */
    public function getContact();

    /**
     * @param ContactInterface $contact
     */
    public function setContact(ContactInterface $contact);
}