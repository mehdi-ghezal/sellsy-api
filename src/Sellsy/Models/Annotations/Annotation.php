<?php

namespace Sellsy\Models\Annotations;

/**
 * Class Annotation
 *
 * @package Sellsy\Models\Annotations
 */
class Annotation implements AnnotationInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $ownerId;

    /**
     * @var string
     */
    protected $relatedType;

    /**
     * @var int
     */
    protected $relatedId;

    /**
     * @var \DateTime
     */
    protected $createAt;

    /**
     * @var \DateTime
     */
    protected $updateAt;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $content;

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
    public function getOwnerId()
    {
        return $this->ownerId;
    }

    /**
     * @inheritdoc
     */
    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;
    }

    /**
     * @inheritdoc
     */
    public function getRelatedType()
    {
        return $this->relatedType;
    }

    /**
     * @inheritdoc
     */
    public function setRelatedType($relatedType)
    {
        $this->relatedType = $relatedType;
    }

    /**
     * @inheritdoc
     */
    public function getRelatedId()
    {
        return $this->relatedId;
    }

    /**
     * @inheritdoc
     */
    public function setRelatedId($relatedId)
    {
        $this->relatedId = $relatedId;
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
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * @inheritdoc
     */
    public function setUpdateAt(\DateTime $updateAt)
    {
        $this->updateAt = $updateAt;
    }

    /**
     * @inheritdoc
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @inheritdoc
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @inheritdoc
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @inheritdoc
     */
    public function setContent($content)
    {
        $this->content = $content;
    }
}
