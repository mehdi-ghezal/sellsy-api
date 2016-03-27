<?php

namespace Sellsy\Models\Documents;

use Sellsy\Models\Documents\Document\StepInterface;

/**
 * Class Delivery
 *
 * @package Sellsy\Models\Documents
 */
class Delivery extends Document implements DeliveryInterface
{
    /**
     * @inheritdoc
     */
    public function isSent()
    {
        return $this->step == StepInterface::STEP_SENT;
    }

    /**
     * @inheritdoc
     */
    public function isRead()
    {
        return $this->step == StepInterface::STEP_READ;
    }
}