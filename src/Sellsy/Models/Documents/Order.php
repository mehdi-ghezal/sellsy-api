<?php

namespace Sellsy\Models\Documents;

/**
 * Class Order
 *
 * @package Sellsy\Models\Documents
 */
class Order extends Document implements OrderInterface
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
}