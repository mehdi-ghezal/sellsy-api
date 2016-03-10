<?php

namespace Sellsy\Tests\Client;

use Sellsy\Api\Clients;
use Sellsy\Criteria\Client\SearchCustomersCriteria;
use Sellsy\Models\Client\CustomerInterface;
use Sellsy\Tests\Fixtures\Components;

/**
 * Class ReadTest
 *
 * @package Sellsy\Tests\Client
 */
class ReadTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return Clients
     */
    public function testClientsApi()
    {
        $catalogue = Components::getApi()->client();

        $this->assertInstanceOf('Sellsy\Api\Clients', $catalogue);

        return $catalogue;
    }

    /**
     * @param Clients $clients
     * @return CustomerInterface
     * @depends testClientsApi
     */
    public function testSearchCustomers(Clients $clients)
    {
        $customers = $clients->searchCustomers(new SearchCustomersCriteria());
        $customer = $customers->current();

        $this->assertInstanceOf('Sellsy\Collections\Collection', $customers);
        $this->assertInstanceOf('Sellsy\Models\Client\CustomerInterface', $customer);

        return $customer;
    }
}
