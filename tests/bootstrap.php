<?php

date_default_timezone_set('Europe/Paris');

require_once __DIR__ . '/../vendor/autoload.php';

if (! file_exists(__DIR__ . '/Fixtures/Catalogue.php')) {
    throw new \RuntimeException('You must create a Fixtures/Catalogue.php file from Fixtures/Catalogue.php.dist and fill all the values');
}

if (! file_exists(__DIR__ . '/Fixtures/Credentials.php')) {
    throw new \RuntimeException('You must create a Fixtures/Credentials.php file from Fixtures/Credentials.php.dist');
}

if (! \Sellsy\Tests\Fixtures\Credentials::$consumerToken ||
    ! \Sellsy\Tests\Fixtures\Credentials::$consumerSecret ||
    ! \Sellsy\Tests\Fixtures\Credentials::$userToken ||
    ! \Sellsy\Tests\Fixtures\Credentials::$userSecret) {

    throw new \RuntimeException('You must fill out Credentials.php');
}