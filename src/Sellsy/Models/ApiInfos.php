<?php

namespace Sellsy\Models;

use Sellsy\Models\Staff\PeopleInterface;

/**
 * Class ApiInfos
 *
 * @package Sellsy\Models
 */
class ApiInfos implements ApiInfosInterface
{
    /**
     * @var string
     */
    protected $version;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var PeopleInterface
     */
    protected $account;

    /**
     * @inheritdoc
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @inheritdoc
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @inheritdoc
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @inheritdoc
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @inheritdoc
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @inheritdoc
     */
    public function setAccount(PeopleInterface $account)
    {
        $this->account = $account;
    }
} 