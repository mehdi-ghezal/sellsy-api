<?php

namespace Sellsy\Criteria\Annotations;

use Sellsy\Criteria\CriteriaInterface;
use Sellsy\Exception\RuntimeException;

/**
 * Class CreateAnnotationCriteria
 *
 * @package Sellsy\Criteria\Annotations
 */
class CreateAnnotationCriteria implements CriteriaInterface
{
    const RELATED_TYPE_DASHBOARD = 'dashboard';
    const RELATED_TYPE_ITEM = 'item';
    const RELATED_TYPE_ESTIMATE = 'estimate';
    const RELATED_TYPE_CREDITNOTE = 'creditnote';
    const RELATED_TYPE_ORDER = 'order';
    const RELATED_TYPE_DELIVERY = 'delivery';
    const RELATED_TYPE_PROFORMA = 'proforma';
    const RELATED_TYPE_INVOICE = 'invoice';
    const RELATED_TYPE_THIRD = 'third';
    const RELATED_TYPE_PEOPLE = 'people';
    const RELATED_TYPE_OPPORTUNITY = 'opportunity';
    const RELATED_TYPE_TASK = 'task';

    /**
     * @var string
     */
    protected $relatedType;

    /**
     * @var string
     */
    protected $relatedId;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var int
     */
    protected $timestamp;

    /**
     * @var int|null
     */
    protected $parentId;

    /**
     * CreateAnnotationCriteria constructor.
     *
     * @param string $relatedType
     * @param int $relatedId
     * @param string $content
     * @param int|null $timestamp
     * @param int|null $parentId
     * @throws RuntimeException
     */
    public function __construct($relatedType, $relatedId, $content, $timestamp = null, $parentId = null)
    {
        switch($relatedType) {
            case self::RELATED_TYPE_DASHBOARD:
            case self::RELATED_TYPE_ITEM:
            case self::RELATED_TYPE_ESTIMATE:
            case self::RELATED_TYPE_CREDITNOTE:
            case self::RELATED_TYPE_ORDER:
            case self::RELATED_TYPE_DELIVERY:
            case self::RELATED_TYPE_PROFORMA:
            case self::RELATED_TYPE_INVOICE:
            case self::RELATED_TYPE_THIRD:
            case self::RELATED_TYPE_PEOPLE:
            case self::RELATED_TYPE_OPPORTUNITY:
            case self::RELATED_TYPE_TASK:
                $this->relatedType = $relatedType;
                break;
            default:
                throw new RuntimeException(sprintf('Invalid related type "%s" provide ; please use RELATED_TYPE_* constant provide by class %s.', $relatedType, static::class));
        }


        $this->relatedId = $relatedId;
        $this->content = $content;
        $this->timestamp = $timestamp ?: time();
        $this->parentId = $parentId;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        $params = array(
            'annotation' => array(
                'relatedtype' => $this->relatedType,
                'relatedid' => $this->relatedId,
                'text' => $this->content,
                'date' => $this->timestamp,
            )
        );

        if ($this->parentId) {
            $params['annotation']['parentid'] = $this->parentId;
        }

        return $params;
    }
} 