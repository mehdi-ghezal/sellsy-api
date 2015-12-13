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
    const TYPE_INVOICE = 'invoice';
    const TYPE_ESTIMATE = 'estimate';
    const TYPE_PROFORMA = 'proforma';
    const TYPE_DELIVERY = 'delivery';
    const TYPE_ORDER = 'order';

    const ORDER_DIRECTION_ASC = 'ASC';
    const ORDER_DIRECTION_DESC = 'DESC';

    const ORDER_BY_IDENTIFIER = 'doc_ident';
    const ORDER_BY_CUSTOMER_NAME = 'doc_thirdname';
    const ORDER_BY_DISPLAY_DATE = 'doc_displayedDate';
    const ORDER_BY_AMOUNT = 'doc_totalAmountTaxesFree';

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
     * @var string
     */
    protected $order = self::ORDER_BY_DISPLAY_DATE;

    /**
     * @var string
     */
    protected $orderDirection = self::ORDER_DIRECTION_ASC;

    /**
     * @var int
     */
    protected $resultsPerPage = 10;

    /**
     * @var int
     */
    protected $page = 1;

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
     * @param $order
     * @throws \Sellsy\Exception\RuntimeException
     */
    public function setOrder($order)
    {
        switch($order) {
            case self::ORDER_BY_IDENTIFIER :
            case self::ORDER_BY_CUSTOMER_NAME :
            case self::ORDER_BY_DISPLAY_DATE :
            case self::ORDER_BY_AMOUNT :
                $this->order = $order;
                break;
            default :
                throw new RuntimeException(sprintf('Invalid order "%s" provide ; please use ORDER_BY_* constant provide by class %s.', $order, __CLASS__));
        }
    }

    /**
     * @return string
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param $orderDirection
     * @throws \Sellsy\Exception\RuntimeException
     */
    public function setOrderDirection($orderDirection)
    {
        switch($orderDirection) {
            case self::ORDER_DIRECTION_ASC :
            case self::ORDER_DIRECTION_DESC :
                $this->orderDirection = $orderDirection;
                break;
            default :
                throw new RuntimeException(sprintf('Invalid order direction "%s" provide ; please use ORDER_DIRECTION_* constant provide by class %s.', $orderDirection, __CLASS__));
        }

    }

    /**
     * @return string
     */
    public function getOrderDirection()
    {
        return $this->orderDirection;
    }

    /**
     * @param int $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int $resultsPerPage
     */
    public function setResultsPerPage($resultsPerPage)
    {
        $this->resultsPerPage = $resultsPerPage;
    }

    /**
     * @return int
     */
    public function getResultsPerPage()
    {
        return $this->resultsPerPage;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        // Initialize parameters
        $parameters = array(
            'doctype' => $this->type,
            'order' => array(
                'order' => $this->order,
                'direction' => $this->orderDirection
            ),
			'pagination' => array (
                'nbperpage'	=> $this->resultsPerPage,
				'pagenum' => $this->page
            ),
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