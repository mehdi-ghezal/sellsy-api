<?php

namespace Sellsy\Models\Accounting;

/**
 * Class Currency
 *
 * @package Sellsy\Models\Accounting
 */
interface CurrencyInterface
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
    public function getSymbol();

    /**
     * @param string $symbol
     */
    public function setSymbol($symbol);
}