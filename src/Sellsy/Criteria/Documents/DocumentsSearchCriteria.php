<?php

namespace Sellsy\Criteria\Documents;

use Sellsy\Exception\RuntimeException;
use Sellsy\Interfaces\CriteriaInterface;

/**
 * Class DocumentsSearchCriteria
 * @package Sellsy\Criteria\Documents
 */
class DocumentsSearchCriteria implements CriteriaInterface
{
    /**
     * @var string
     */
    const TYPE_INVOICE = 'invoice';

    /**
     * @var string
     */
    const TYPE_ESTIMATE = 'estimate';

    /**
     * @var string
     */
    const TYPE_PROFORMA = 'proforma';

    /**
     * @var string
     */
    const TYPE_DELIVERY = 'delivery';

    /**
     * @var string
     */
    const TYPE_ORDER = 'order';

    /**
     * @var string
     */
    protected $type;

    /**
     * @var \DateTime
     */
    protected $createPeriodStart;

    /**
     * @var \DateTime
     */
    protected $createPeriodEnd;

    /**
     * @var \DateTime
     */
    protected $expirePeriodStart;

    /**
     * @var \DateTime
     */
    protected $expirePeriodEnd;

    /**
     * Constructor
     *
     * @param $type
     */
    public function __construct($type)
    {
        $this->setType($type);
    }

    /**
     * @param $type
     * @throws \Sellsy\Exception\RuntimeException
     */
    public function setType($type)
    {
        switch($type) {
            case self::TYPE_INVOICE :
            case self::TYPE_ESTIMATE :
            case self::TYPE_PROFORMA :
            case self::TYPE_DELIVERY :
            case self::TYPE_ORDER :
                $this->type = $type;
                break;
            default :
                throw new RuntimeException(sprintf('Invalid type "%s" provide ; please use TYPE_* constant provide by class %s.', $type, __CLASS__));
        }
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param \DateTime $createPeriodStart
     */
    public function setCreatePeriodStart(\DateTime $createPeriodStart)
    {
        $this->createPeriodStart = $createPeriodStart;
    }

    /**
     * @return \DateTime
     */
    public function getCreatePeriodStart()
    {
        return $this->createPeriodStart;
    }

    /**
     * @param \DateTime $createPeriodEnd
     */
    public function setCreatePeriodEnd(\DateTime $createPeriodEnd)
    {
        $this->createPeriodEnd = $createPeriodEnd;
    }

    /**
     * @return \DateTime
     */
    public function getCreatePeriodEnd()
    {
        return $this->createPeriodEnd;
    }

    /**
     * @param \DateTime $expirePeriodStart
     */
    public function setExpirePeriodStart($expirePeriodStart)
    {
        $this->expirePeriodStart = $expirePeriodStart;
    }

    /**
     * @return \DateTime
     */
    public function getExpirePeriodStart()
    {
        return $this->expirePeriodStart;
    }

    /**
     * @param \DateTime $expirePeriodEnd
     */
    public function setExpirePeriodEnd($expirePeriodEnd)
    {
        $this->expirePeriodEnd = $expirePeriodEnd;
    }

    /**
     * @return \DateTime
     */
    public function getExpirePeriodEnd()
    {
        return $this->expirePeriodEnd;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        // Initialize parameters
        $parameters = array(
            'doctype' => $this->type,
            'search' => array()
        );

        // Handle period search
        if ($this->createPeriodStart) {
            $parameters['search']['periodecreated_start'] = $this->createPeriodStart->getTimestamp();
        }

        if ($this->createPeriodEnd) {
            $parameters['search']['periodecreated_end'] = $this->createPeriodEnd->getTimestamp();
        }
        if ($this->expirePeriodStart) {
            $parameters['search']['periodeexpired_start'] = $this->expirePeriodStart->getTimestamp();
        }

        if ($this->expirePeriodEnd) {
            $parameters['search']['periodeexpired_end'] = $this->expirePeriodEnd->getTimestamp();
        }

        /*
        'includePayments' => {{includePayments}}
        'search' => array(
            'ident'		=>	{{ident}},
            'steps'		=>	{{steps}},
            'thirds'	=>	{{thirds}},
            'tags'		=>	{{tags}}
        )
        */

        // Cleaning parameters
        if (! count($parameters['search'])) {
            unset($parameters['search']);
        }

        return $parameters;
    }
} 