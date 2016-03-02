<?php

namespace Sellsy\Models\Documents;

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
}