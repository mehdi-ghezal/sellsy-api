<?php

namespace Sellsy\Models;

/**
 * Class ApiInfos
 * @package Sellsy\Models
 */
class ApiInfos implements ApiInfosInterface
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
     * @var \Sellsy\Models\Staff\PeopleInterface
     * @copy {
     *      "userdatas.staffId" : "id",
     *      "userdatas.forename": "firstName",
     *      "userdatas.name": "lastName",
     *      "userdatas.fullName": "fullName",
     *      "userdatas.mail": "email"
     * }
     */
    public $account;
} 