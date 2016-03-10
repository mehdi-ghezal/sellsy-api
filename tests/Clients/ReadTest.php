<?php

namespace Sellsy\Tests\Client;

use Sellsy\Api\Clients;
use Sellsy\Criteria\Client\SearchCustomersCriteria;
use Sellsy\Models\Client\Customer;
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

    /**
     * @param Customer $customer
     * @depends testSearchCustomers
     */
    public function testCustomerMappings(Customer $customer)
    {
        $this->assertInstanceOf('Sellsy\Models\Addresses\AddressInterface', $customer->getAddress(function () { return true; }));
        $this->assertInstanceOf('Sellsy\Models\Client\ContactInterface', $customer->getContact(function () { return true; }));
        $this->assertInstanceOf('Sellsy\Models\Addresses\AddressInterface', $customer->getMainAddress());
        $this->assertInstanceOf('Sellsy\Models\Client\ContactInterface', $customer->getMainContact());
        $this->assertInstanceOf('Sellsy\Models\Staff\PeopleInterface', $customer->getOwner());
        $this->assertInstanceOf('\DateTime', $customer->getCreateAt());

        $this->assertInternalType('array', $customer->getAddresses());
        $this->assertGreaterThan(0, count($customer->getAddresses()));

        $this->assertInternalType('array', $customer->getContacts());
        $this->assertGreaterThan(0, count($customer->getContacts()));

        $this->assertInternalType('integer', $customer->getId());

        $this->assertEquals('email_value', $customer->getEmail());
        $this->assertEquals('fax_value', $customer->getFax());
        $this->assertEquals('fullName_value', $customer->getFullName());
        $this->assertEquals('tel_value', $customer->getPhoneNumber());
        $this->assertEquals('mobile_value', $customer->getMobileNumber());
        $this->assertEquals('apenaf_value', $customer->getNafCode());
        $this->assertEquals('name_value', $customer->getName());
        $this->assertEquals('pic_value', $customer->getPicture());
        $this->assertEquals('rcs_value', $customer->getRcs());
        $this->assertEquals('siret_value', $customer->getSiret());
        $this->assertEquals('vat_value', $customer->getVatNumber());
        $this->assertEquals('webUrl_value', $customer->getWebsite());

        $this->assertFalse($customer->isMassmailingUnsubscribed());
        $this->assertFalse($customer->isMassmailingUnsubscribedSMS());
    }
}