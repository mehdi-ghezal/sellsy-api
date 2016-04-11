<?php

namespace Sellsy\Models\Client;

use Sellsy\Models\Addresses\AddressInterface;
use Sellsy\Models\CustomFields\CustomFieldTraitInterface;
use Sellsy\Models\Staff\PeopleInterface;

/**
 * Class Customer
 *
 * @package Sellsy\Models\Client
 */
interface CustomerInterface extends CustomFieldTraitInterface
{
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
    public function getEmail();

    /**
     * @param string $email
     */
    public function setEmail($email);

    /**
     * @return string
     */
    public function getPhoneNumber();

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber);

    /**
     * @return string
     */
    public function getMobileNumber();

    /**
     * @param string $mobileNumber
     */
    public function setMobileNumber($mobileNumber);

    /**
     * @return string
     */
    public function getFullName();

    /**
     * @param string $fullName
     */
    public function setFullName($fullName);

    /**
     * @return \DateTime
     */
    public function getCreateAt();

    /**
     * @param \DateTime $createAt
     */
    public function setCreateAt(\DateTime $createAt);

    /**
     * @return string
     */
    public function getPicture();

    /**
     * @param string $picture
     */
    public function setPicture($picture);

    /**
     * @return string
     */
    public function getFax();

    /**
     * @param string $fax
     */
    public function setFax($fax);

    /**
     * @return string
     */
    public function getNafCode();

    /**
     * @param string $nafCode
     */
    public function setNafCode($nafCode);

    /**
     * @return string
     */
    public function getRcs();

    /**
     * @param string $rcs
     */
    public function setRcs($rcs);

    /**
     * @return string
     */
    public function getSiret();

    /**
     * @param string $siret
     */
    public function setSiret($siret);

    /**
     * @return string
     */
    public function getVatNumber();

    /**
     * @param string $vatNumber
     */
    public function setVatNumber($vatNumber);

    /**
     * @return string
     */
    public function getWebsite();

    /**
     * @param string $website
     */
    public function setWebsite($website);

    /**
     * @return boolean
     */
    public function isMassmailingUnsubscribed();

    /**
     * @param boolean $massmailingUnsubscribed
     */
    public function setMassmailingUnsubscribed($massmailingUnsubscribed);

    /**
     * @return boolean
     */
    public function isMassmailingUnsubscribedSMS();

    /**
     * @param boolean $massmailingUnsubscribedSMS
     */
    public function setMassmailingUnsubscribedSMS($massmailingUnsubscribedSMS);

    /**
     * @return PeopleInterface
     */
    public function getOwner();

    /**
     * @param PeopleInterface $owner
     */
    public function setOwner(PeopleInterface $owner);

    /**
     * @return ContactInterface[]
     */
    public function getContacts();

    /**
     * @param \Closure $closure
     * @return null|ContactInterface
     */
    public function getContact(\Closure $closure);

    /**
     * @param ContactInterface[] $contacts
     */
    public function setContacts(array $contacts);

    /**
     * @param ContactInterface $contact
     */
    public function addContact(ContactInterface $contact);

    /**
     * @param \Closure $closure
     * @return null|AddressInterface
     */
    public function getAddress(\Closure $closure);

    /**
     * @return AddressInterface[]
     */
    public function getAddresses();

    /**
     * @param AddressInterface[] $addresses
     */
    public function setAddresses(array $addresses);

    /**
     * @param AddressInterface $address
     */
    public function addAddresses(AddressInterface $address);

    /**
     * @param int $mainAddressId
     */
    public function setMainAddressId($mainAddressId);

    /**
     * @return null|AddressInterface
     */
    public function getMainAddress();

    /**
     * @param int $mainContactId
     */
    public function setMainContactId($mainContactId);

    /**
     * @return null|ContactInterface
     */
    public function getMainContact();
}