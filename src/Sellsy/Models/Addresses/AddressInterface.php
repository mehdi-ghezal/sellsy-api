<?php

namespace Sellsy\Models\Addresses;

/**
 * Interface AddressInterface
 *
 * @package Sellsy\Models\Addresses
 */
interface AddressInterface
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
    public function getPart1();

    /**
     * @param string $part1
     */
    public function setPart1($part1);

    /**
     * @return string
     */
    public function getPart2();

    /**
     * @param string $part2
     */
    public function setPart2($part2);

    /**
     * @return string
     */
    public function getZip();

    /**
     * @param string $zip
     */
    public function setZip($zip);

    /**
     * @return string
     */
    public function getCity();

    /**
     * @param string $city
     */
    public function setCity($city);

    /**
     * @return string
     */
    public function getState();

    /**
     * @param string $state
     */
    public function setState($state);

    /**
     * @return string
     */
    public function getCountryCode();

    /**
     * @param string $countryCode
     */
    public function setCountryCode($countryCode);

    /**
     * @return string
     */
    public function getLat();

    /**
     * @param string $lat
     */
    public function setLat($lat);

    /**
     * @return string
     */
    public function getLng();

    /**
     * @param string $lng
     */
    public function setLng($lng);

    /**
     * @return string
     */
    public function getFormattedAddress();

    /**
     * @param string $formattedAddress
     */
    public function setFormattedAddress($formattedAddress);

    /**
     * @return string
     */
    public function __toString();
}