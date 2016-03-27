<?php

namespace Sellsy\Models\Documents;

use Sellsy\Models\Documents\Document\StepInterface;

/**
 * Class Invoice
 *
 * @package Sellsy\Models\Documents
 */
class Invoice extends Document implements InvoiceInterface
{
    /**
     * @var float
     */
    protected $dueAmount;

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
     * @inheritdoc
     */
    public function getDueAmount()
    {
        return $this->dueAmount;
    }

    /**
     * @inheritdoc
     */
    public function setDueAmount($dueAmount)
    {
        $this->dueAmount = $dueAmount;
    }

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
    public function isPaymentDue()
    {
        return $this->step->getName() == StepInterface::STEP_PAYMENT_DUE;
    }

    /**
     * @inheritdoc
     */
    public function isPaymentPartial()
    {
        return $this->step->getName() == StepInterface::STEP_PAYMENT_PARTIAL;
    }

    /**
     * @inheritdoc
     */
    public function isPaymentDone()
    {
        return $this->step->getName() == StepInterface::STEP_PAYMENT_DONE;
    }

    /**
     * @inheritdoc
     */
    public function isPaymentLate()
    {
        return $this->step->getName() == StepInterface::STEP_PAYMENT_LATE;
    }

    /**
     * @inheritdoc
     */
    public function isCancelled()
    {
        return $this->step->getName() == StepInterface::STEP_CANCELLED;
    }
}