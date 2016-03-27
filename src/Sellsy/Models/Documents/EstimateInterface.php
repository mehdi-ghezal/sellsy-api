<?php

namespace Sellsy\Models\Documents;

/**
 * Interface EstimateInterface
 *
 * @package Sellsy\Models\Documents
 */
interface EstimateInterface extends DocumentInterface
{
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
     * @return \DateTime
     */
    public function getExpireAt();

    /**
     * @param \DateTime $expireAt
     */
    public function setExpireAt(\DateTime $expireAt);

    /**
     * @return bool
     */
    public function isSent();

    /**
     * @return bool
     */
    public function isRead();

    /**
     * @return bool
     */
    public function isAccepted();

    /**
     * @return bool
     */
    public function isRefused();

    /**
     * @return bool
     */
    public function isExpired();

    /**
     * @return bool
     */
    public function isDeposit();

    /**
     * @return bool
     */
    public function isInvoiced();

    /**
     * @return bool
     */
    public function isInvoicedCancelled();
}