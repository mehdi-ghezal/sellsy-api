<?php

namespace Sellsy\Models\Documents;

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
}