<?php

namespace Sellsy\Models\Accounting;

/**
 * Class Currency
 *
 * @package Sellsy\Models\Accounting
 */
class Currency implements CurrencyInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $symbol;

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @inheritdoc
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * @inheritdoc
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;
    }
}