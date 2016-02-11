<?php

namespace Sellsy\Criteria\Documents;

use Sellsy\Criteria\Generic\GetListCriteria;
use Sellsy\Exception\RuntimeException;

/**
 * Class SearchCriteria
 * @package Sellsy\Criteria\Documents
 */
abstract class SearchCriteria extends GetListCriteria
{
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
     * @var array
     */
    protected $steps;

    /**
     * @return string
     */
    abstract protected function getType();

    /**
     * @return array
     */
    abstract protected function getValidSteps();

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
     * @param $step
     * @return $this
     * @throws RuntimeException
     */
    public function addStep($step)
    {
        if (! in_array($step, $this->getValidSteps())) {
            throw new RuntimeException(sprintf('Invalid step "%s" provide ; please use STEP_* constant provide by class %s.', $step, static::class));
        }

        $this->steps[] = $step;
        return $this;
    }

    /**
     * @param array $steps
     * @return $this
     */
    public function setSteps(array $steps)
    {
        $this->clearSteps();

        foreach($steps as $step) {
            $this->addStep($step);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function clearSteps()
    {
        $this->steps = array();
        return $this;
    }

    /**
     * @return array
     */
    public function getSteps()
    {
        return $this->steps;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        // Initialize parameters
        $parameters = array(
            'doctype' => $this->getType(),
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

        if ($this->tags) {
            $parameters['search']['tags'] = implode(',', $this->tags);
        }

        if ($this->steps) {
            $parameters['search']['steps'] = $this->steps;
        }

        // Cleaning parameters
        if (! count($parameters['search'])) {
            unset($parameters['search']);
        }

        return $parameters;
    }
}
