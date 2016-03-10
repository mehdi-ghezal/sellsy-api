<?php

namespace Sellsy\Models\Addresses;

/**
 * Class Address
 *
 * @package Sellsy\Models\Addresses
 */
class Address implements AddressInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $part1;

    /**
     * @var string
     */
    protected $part2;

    /**
     * @var string
     */
    protected $zip;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $state;

    /**
     * @var string
     */
    protected $countryCode;

    /**
     * @var string
     */
    protected $lat;

    /**
     * @var string
     */
    protected $lng;

    /**
     * @var string
     */
    protected $formattedAddress;

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
    public function getPart1()
    {
        return $this->part1;
    }

    /**
     * @inheritdoc
     */
    public function setPart1($part1)
    {
        $this->part1 = $part1;
    }

    /**
     * @inheritdoc
     */
    public function getPart2()
    {
        return $this->part2;
    }

    /**
     * @inheritdoc
     */
    public function setPart2($part2)
    {
        $this->part2 = $part2;
    }

    /**
     * @inheritdoc
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @inheritdoc
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * @inheritdoc
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @inheritdoc
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @inheritdoc
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @inheritdoc
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @inheritdoc
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @inheritdoc
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    /**
     * @inheritdoc
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @inheritdoc
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    /**
     * @inheritdoc
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * @inheritdoc
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
    }

    /**
     * @inheritdoc
     */
    public function getFormattedAddress()
    {
        return $this->formattedAddress;
    }

    /**
     * @inheritdoc
     */
    public function setFormattedAddress($formattedAddress)
    {
        $this->formattedAddress = $formattedAddress;
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return $this->getFormattedAddress();
    }
}