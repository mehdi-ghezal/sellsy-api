<?php

namespace Sellsy\Models\Documents;

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
}