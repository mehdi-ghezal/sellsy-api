<?php

namespace Sellsy\Models\Documents;

use Sellsy\Models\Documents\Document\StepInterface;

/**
 * Class Estimate
 *
 * @package Sellsy\Models\Documents
 */
class Estimate extends Document implements EstimateInterface
{
    /**
     * @var float
     */
    protected $marginAmount;

    /**
     * @var float
     */
    protected $marginRate;

    /**
     * @var float
     */
    protected $markupRate;

    /**
     * @var \DateTime
     */
    protected $expireAt;

    /**
     * @inheritdoc
     */
    public function getMarginAmount()
    {
        return $this->marginAmount;
    }

    /**
     * @inheritdoc
     */
    public function setMarginAmount($marginAmount)
    {
        $this->marginAmount = $marginAmount;
    }

    /**
     * @inheritdoc
     */
    public function getMarginRate()
    {
        return $this->marginRate;
    }

    /**
     * @inheritdoc
     */
    public function setMarginRate($marginRate)
    {
        $this->marginRate = $marginRate;
    }

    /**
     * @inheritdoc
     */
    public function getMarkupRate()
    {
        return $this->markupRate;
    }

    /**
     * @inheritdoc
     */
    public function setMarkupRate($markupRate)
    {
        $this->markupRate = $markupRate;
    }

    /**
     * @inheritdoc
     */
    public function getExpireAt()
    {
        return $this->expireAt;
    }

    /**
     * @inheritdoc
     */
    public function setExpireAt(\DateTime $expireAt)
    {
        $this->expireAt = $expireAt;
    }

    /**
     * @inheritdoc
     */
    public function isSent()
    {
        return $this->step->getName() == StepInterface::STEP_SENT;
    }

    /**
     * @inheritdoc
     */
    public function isRead()
    {
        return $this->step->getName() == StepInterface::STEP_READ;
    }

    /**
     * @inheritdoc
     */
    public function isAccepted()
    {
        return $this->step->getName() == StepInterface::STEP_ACCEPTED;
    }

    /**
     * @inheritdoc
     */
    public function isRefused()
    {
        return $this->step->getName() == StepInterface::STEP_REFUSED;
    }

    /**
     * @inheritdoc
     */
    public function isExpired()
    {
        return $this->step->getName() == StepInterface::STEP_EXPIRED;
    }

    /**
     * @inheritdoc
     */
    public function isDeposit()
    {
        return $this->step->getName() == StepInterface::STEP_DEPOSIT;
    }

    /**
     * @inheritdoc
     */
    public function isInvoiced()
    {
        return $this->step->getName() == StepInterface::STEP_INVOICED;
    }

    /**
     * @inheritdoc
     */
    public function isInvoicedCancelled()
    {
        return $this->step->getName() == StepInterface::STEP_CANCELLED;
    }
}