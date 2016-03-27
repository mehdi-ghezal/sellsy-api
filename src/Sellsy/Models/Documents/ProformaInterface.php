<?php

namespace Sellsy\Models\Documents;

/**
 * Interface ProformaInterface
 *
 * @package Sellsy\Models\Documents
 */
interface ProformaInterface extends DocumentInterface
{
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
    public function isRead();

    /**
     * @return bool
     */
    public function isAccepted();

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
    public function isCancelled();
}