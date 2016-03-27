<?php

namespace Sellsy\Models\Documents\Document;

/**
 * Interface StepInterface
 *
 * @package Sellsy\Models\Documents\Document
 */
interface StepInterface
{
    /**
     * @var string
     */
    const STEP_DRAFT = 'draft';

    /**
     * @var string
     */
    const STEP_SENT = 'sent';

    /**
     * @var string
     */
    const STEP_READ = 'read';

    /**
     * @var string
     */
    const STEP_INVOICED_PARTIALLY = 'partialinvoiced';

    /**
     * @var string
     */
    const STEP_INVOICED = 'invoiced';

    /**
     * @var string
     */
    const STEP_ACCEPTED = 'accepted';

    /**
     * @var string
     */
    const STEP_REFUSED = 'refused';

    /**
     * @var string
     */
    const STEP_EXPIRED = 'expired';

    /**
     * @var string
     */
    const STEP_DEPOSIT = 'advanced';

    /**
     * @var string
     */
    const STEP_CANCELLED = 'cancelled';

    /**
     * @var string
     */
    const STEP_PAYMENT_DUE = 'due';

    /**
     * @var string
     */
    const STEP_PAYMENT_PARTIAL = 'payinprogress';

    /**
     * @var string
     */
    const STEP_PAYMENT_DONE = 'paid';

    /**
     * @var string
     */
    const STEP_PAYMENT_LATE = 'late';

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
    public function getName();

    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getLabel();

    /**
     * @param string $label
     */
    public function setLabel($label);
}