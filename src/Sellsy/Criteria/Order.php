<?php

namespace Sellsy\Criteria;
use Sellsy\Exception\RuntimeException;
use Sellsy\Interfaces\CriteriaInterface;

/**
 * Class Order
 * @package Sellsy\Criteria
 */
class Order implements CriteriaInterface
{
    /**
     * @var string
     */
    const DIRECTION_ASC = 'ASC';

    /**
     * @var string
     */
    const DIRECTION_DESC = 'DESC';

    /**
     * @var string
     */
    protected $direction;

    /**
     * @var string
     */
    protected $order;

    /**
     * @param $direction
     * @throws RuntimeException
     */
    public function setDirection($direction)
    {
        switch($direction) {
            case self::DIRECTION_ASC :
            case self::DIRECTION_DESC :
                $this->direction = $direction;
                break;
            default :
                throw new RuntimeException(sprintf('Invalid direction "%s" provide ; please use DIRECTION_* constant provide by class %s.', $direction, __CLASS__));
        }
    }

    /**
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * @return string
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param string $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return array(
            'order' => array(
                'direction' => $this->direction,
                'order' => $this->order
            )
        );
    }
}
