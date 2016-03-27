<?php

namespace Sellsy\Models\Documents;

/**
 * Interface InvoiceInterface
 *
 * @package Sellsy\Models\Documents
 */
interface InvoiceInterface extends DocumentInterface
{
    /**
     * @return float
     */
    public function getDueAmount();

    /**
     * @param float $dueAmount
     */
    public function setDueAmount($dueAmount);

    /**
     * @return float
     */
    public function getMarginAmount();

    /**
     * @param float $marginAmount
     */
    public function setMarginAmount($marginAmount);

    /**
     * @return float
     */
    public function getMarginRate();

    /**
     * @param float $marginRate
     */
    public function setMarginRate($marginRate);

    /**
     * @return float
     */
    public function getMarkupRate();

    /**
     * @param float $markupRate
     */
    public function setMarkupRate($markupRate);

    /**
     * @return bool
     */
    public function isPaymentDue();

    /**
     * @return bool
     */
    public function isPaymentPartial();

    /**
     * @return bool
     */
    public function isPaymentDone();

    /**
     * @return bool
     */
    public function isPaymentLate();

    /**
     * @return bool
     */
    public function isCancelled();
}