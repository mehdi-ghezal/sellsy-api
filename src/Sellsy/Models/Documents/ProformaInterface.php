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
}