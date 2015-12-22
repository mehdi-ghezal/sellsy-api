<?php

namespace Sellsy\Models\Documents;

use Sellsy\Models\Documents\Document\Step;
use Sellsy\Models\Staff\People;

/**
 * Class Document
 * @package Sellsy\Models\Documents
 */
class Document
{
    /**
     * @var int
     * @copy
     */
    public $id;

    /**
     * @var string
     * @copy ident
     */
    public $reference;

    /**
     * @var string
     * @copy
     */
    public $note;

    /**
     * @var \DateTime
     * @copy created
     * @convert date
     */
    public $createdDate;

    /**
     * @var \DateTime
     * @copy displayedDate
     * @convert date
     */
    public $displayDate;

    /**
     * @var Step
     * @copy {
     *      "step_id" : "id",
     *      "step": "name"
     * }
     */
    public $step;

    /**
     * @var People
     * @copy {
     *      "ownerid" : "id",
     *      "ownerFullName": "fullName"
     * }
     */
    public $owner;

    /**
     * Document constructor: Initialize attributes
     */
    public function __construct()
    {
        $this->owner = new People();
        $this->step = new Step();
    }
} 