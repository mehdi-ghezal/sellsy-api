<?php

namespace Sellsy\Models\Client;

use Sellsy\Models\Addresses\AddressInterface;
use Sellsy\Models\CustomFields\CustomFieldTrait;
use Sellsy\Models\Staff\PeopleInterface;

/**
 * Class Customer
 *
 * @package Sellsy\Models\Client
 */
class Customer implements CustomerInterface
{
    use CustomFieldTrait;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var \DateTime
     */
    protected $createAt;

    /**
     * @var string
     */
    protected $picture;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $fullName;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $phoneNumber;

    /**
     * @var string
     */
    protected $mobileNumber;

    /**
     * @var string
     */
    protected $fax;

    /**
     * @var string
     */
    protected $nafCode;

    /**
     * @var string
     */
    protected $rcs;

    /**
     * @var string
     */
    protected $siret;

    /**
     * @var string
     */
    protected $vatNumber;

    /**
     * @var string
     */
    protected $website;

    /**
     * @var bool
     */
    protected $massmailingUnsubscribed;

    /**
     * @var bool
     */
    protected $massmailingUnsubscribedSMS;

    /**
     * @var int
     */
    protected $mainAddressId;

    /**
     * @var int
     */
    protected $mainContactId;

    /**
     * @var PeopleInterface
     */
    protected $owner;

    /**
     * @var ContactInterface[]
     */
    protected $contacts;

    /**
     * @var AddressInterface[]
     */
    protected $addresses;

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @inheritdoc
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @inheritdoc
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @inheritdoc
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @inheritdoc
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @inheritdoc
     */
    public function getMobileNumber()
    {
        return $this->mobileNumber;
    }

    /**
     * @inheritdoc
     */
    public function setMobileNumber($mobileNumber)
    {
        $this->mobileNumber = $mobileNumber;
    }

    /**
     * @inheritdoc
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @inheritdoc
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @inheritdoc
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * @inheritdoc
     */
    public function setCreateAt(\DateTime $createAt)
    {
        $this->createAt = $createAt;
    }

    /**
     * @inheritdoc
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @inheritdoc
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @inheritdoc
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @inheritdoc
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    /**
     * @inheritdoc
     */
    public function getNafCode()
    {
        return $this->nafCode;
    }

    /**
     * @inheritdoc
     */
    public function setNafCode($nafCode)
    {
        $this->nafCode = $nafCode;
    }

    /**
     * @inheritdoc
     */
    public function getRcs()
    {
        return $this->rcs;
    }

    /**
     * @inheritdoc
     */
    public function setRcs($rcs)
    {
        $this->rcs = $rcs;
    }

    /**
     * @inheritdoc
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * @inheritdoc
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;
    }

    /**
     * @inheritdoc
     */
    public function getVatNumber()
    {
        return $this->vatNumber;
    }

    /**
     * @inheritdoc
     */
    public function setVatNumber($vatNumber)
    {
        $this->vatNumber = $vatNumber;
    }

    /**
     * @inheritdoc
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @inheritdoc
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * @inheritdoc
     */
    public function isMassmailingUnsubscribed()
    {
        return $this->massmailingUnsubscribed;
    }

    /**
     * @inheritdoc
     */
    public function setMassmailingUnsubscribed($massmailingUnsubscribed)
    {
        $this->massmailingUnsubscribed = $massmailingUnsubscribed;
    }

    /**
     * @inheritdoc
     */
    public function isMassmailingUnsubscribedSMS()
    {
        return $this->massmailingUnsubscribedSMS;
    }

    /**
     * @inheritdoc
     */
    public function setMassmailingUnsubscribedSMS($massmailingUnsubscribedSMS)
    {
        $this->massmailingUnsubscribedSMS = $massmailingUnsubscribedSMS;
    }

    /**
     * @inheritdoc
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @inheritdoc
     */
    public function setOwner(PeopleInterface $owner)
    {
        $this->owner = $owner;
    }

    /**
     * @inheritdoc
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * @inheritdoc
     */
    public function getContact(\Closure $closure)
    {
        foreach($this->contacts as $contact) {
            if ($closure($contact)) {
                return $contact;
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function setContacts(array $contacts)
    {
        $this->contacts = $contacts;
    }

    /**
     * @inheritdoc
     */
    public function addContact(ContactInterface $contact)
    {
        $this->contacts[] = $contact;
    }

    /**
     * @param \Closure $closure
     * @return null|AddressInterface
     */
    public function getAddress(\Closure $closure)
    {
        foreach($this->addresses as $address) {
            if ($closure($address)) {
                return $address;
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * @inheritdoc
     */
    public function setAddresses(array $addresses)
    {
        $this->addresses = $addresses;
    }

    /**
     * @inheritdoc
     */
    public function addAddresses(AddressInterface $address)
    {
        $this->addresses[] = $address;
    }

    /**
     * @inheritdoc
     */
    public function getMainAddressId()
    {
        return $this->mainAddressId;
    }

    /**
     * @inheritdoc
     */
    public function setMainAddressId($mainAddressId)
    {
        $this->mainAddressId = $mainAddressId;
    }

    /**
     * @inheritdoc
     */
    public function getMainAddress()
    {
        return $this->getAddress(function($address) {
            return $address->getId() == $this->mainAddressId;
        });
    }

    /**
     * @inheritdoc
     */
    public function getMainContactId()
    {
        return $this->mainContactId;
    }

    /**
     * @inheritdoc
     */
    public function setMainContactId($mainContactId)
    {
        $this->mainContactId = $mainContactId;
    }

    /**
     * @inheritdoc
     */
    public function getMainContact()
    {
        return $this->getContact(function($contact) {
            return $contact->getId() == $this->mainContactId;
        });
    }
}