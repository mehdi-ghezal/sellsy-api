<?php

namespace Sellsy\Models\Documents;

/**
 * Interface DeliveryInterface
 *
 * @package Sellsy\Models\Documents
 */
interface DeliveryInterface extends DocumentInterface
{
    /**
     * @return bool
     */
    public function isSent();

    /**
     * @return bool
     */
    public function isRead();
}