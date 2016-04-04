<?php

namespace Sellsy\Models\Annotations;

/**
 * Interface AnnotationInterface
 *
 * @package Sellsy\Models\Annotations
 */
interface AnnotationInterface
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
     * @return int
     */
    public function getOwnerId();

    /**
     * @param int $ownerId
     */
    public function setOwnerId($ownerId);

    /**
     * @return string
     */
    public function getRelatedType();

    /**
     * @param string $relatedType
     */
    public function setRelatedType($relatedType);

    /**
     * @return int
     */
    public function getRelatedId();

    /**
     * @param int $relatedId
     */
    public function setRelatedId($relatedId);

    /**
     * @return \DateTime
     */
    public function getCreateAt();

    /**
     * @param \DateTime $createAt
     */
    public function setCreateAt(\DateTime $createAt);

    /**
     * @return \DateTime
     */
    public function getUpdateAt();

    /**
     * @param \DateTime $updateAt
     */
    public function setUpdateAt(\DateTime $updateAt);

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param string $title
     */
    public function setTitle($title);

    /**
     * @return string
     */
    public function getContent();

    /**
     * @param string $content
     */
    public function setContent($content);
}