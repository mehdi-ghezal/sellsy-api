<?php

namespace Sellsy\Models;

use Sellsy\Models\Staff\PeopleInterface;

/**
 * Interface ApiInfosInterface
 *
 * @package Sellsy\Models
 */
interface ApiInfosInterface
{
    /**
     * @return string
     */
    public function getVersion();

    /**
     * @param string $version
     */
    public function setVersion($version);

    /**
     * @return string
     */
    public function getStatus();

    /**
     * @param string $status
     */
    public function setStatus($status);

    /**
     * @return PeopleInterface
     */
    public function getAccount();

    /**
     * @param PeopleInterface $account
     */
    public function setAccount(PeopleInterface $account);
}