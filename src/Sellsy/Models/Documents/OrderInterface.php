<?php

namespace Sellsy\Models\Documents;

/**
 * Interface OrderInterface
 *
 * @package Sellsy\Models\Documents
 */
interface OrderInterface extends DocumentInterface
{
    /**
     * @return \DateTime
     */
    public function getExpireAt();

    /**
     * @param \DateTime $expireAt
     */
    public function setExpireAt(\DateTime $expireAt);
}