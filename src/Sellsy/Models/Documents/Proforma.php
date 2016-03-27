<?php

namespace Sellsy\Models\Documents;

use Sellsy\Models\Documents\Document\StepInterface;

/**
 * Class Proforma
 *
 * @package Sellsy\Models\Documents
 */
class Proforma extends Document implements ProformaInterface
{
    /**
     * @var \DateTime
     */
    protected $expireAt;

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
    public function isRead()
    {
        return $this->step == StepInterface::STEP_READ;
    }

    /**
     * @inheritdoc
     */
    public function isAccepted()
    {
        return $this->step == StepInterface::STEP_ACCEPTED;
    }

    /**
     * @inheritdoc
     */
    public function isExpired()
    {
        return $this->step == StepInterface::STEP_EXPIRED;
    }

    /**
     * @inheritdoc
     */
    public function isDeposit()
    {
        return $this->step == StepInterface::STEP_DEPOSIT;
    }

    /**
     * @inheritdoc
     */
    public function isInvoiced()
    {
        return $this->step == StepInterface::STEP_INVOICED;
    }

    /**
     * @inheritdoc
     */
    public function isCancelled()
    {
        return $this->step == StepInterface::STEP_CANCELLED;
    }
}