<?php

namespace Sellsy\Models;

use Sellsy\Models\Staff\People;

/**
 * Class ApiInfos
 * @package Sellsy\Models
 */
class ApiInfos
{
    /**
     * @var string
     * @copy apidatas.version
     */
    public $version;

    /**
     * @var string
     * @copy apidatas.status
     */
    public $status;

    /**
     * @var People
     * @copy {
     *      "userdatas.staffId" : "id",
     *      "userdatas.forename": "firstName",
     *      "userdatas.name": "lastName",
     *      "userdatas.fullName": "fullName",
     *      "userdatas.mail": "email"
     * }
     */
    public $account;

    /**
     * ApiInfos constructor: Initialize attributes
     */
    public function __construct()
    {
        $this->account = new People();
    }
} 