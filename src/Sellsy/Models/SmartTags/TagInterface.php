<?php

namespace Sellsy\Models\SmartTags;

/**
 * Interface TagInterface
 *
 * @package Sellsy\Models\SmartTags
 */
interface TagInterface
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
    public function getCategory();

    /**
     * @param string $category
     */
    public function setCategory($category);
}