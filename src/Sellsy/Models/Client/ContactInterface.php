<?php

namespace Sellsy\Models\Client;

/**
 * Class Contact
 *
 * @package Sellsy\Models\Client
 */
interface ContactInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getFullName();

    /**
     * @param string $fullName
     */
    public function setFullName($fullName);
}