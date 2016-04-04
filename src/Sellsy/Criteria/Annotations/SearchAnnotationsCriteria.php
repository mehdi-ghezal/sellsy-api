<?php

namespace Sellsy\Criteria\Annotations;

use Sellsy\Criteria\CriteriaInterface;
use Sellsy\Exception\RuntimeException;

/**
 * Class SearchAnnotationsCriteria
 *
 * @package Sellsy\Criteria\Annotations
 */
class SearchAnnotationsCriteria implements CriteriaInterface
{
    const RELATED_TYPE_DASHBOARD = 'dashboard';
    const RELATED_TYPE_THIRD = 'third';
    const RELATED_TYPE_PEOPLE = 'people';
    const RELATED_TYPE_OPPORTUNITY = 'opportunity';
    const RELATED_TYPE_ITEM = 'item';
    const RELATED_TYPE_TASK = 'task';
    const RELATED_TYPE_DOCUMENT = 'document';

    /**
     * @var string
     */
    protected $relatedType;

    /**
     * @var string
     */
    protected $relatedId;

    /**
     * SearchAnnotationsCriteria constructor.
     *
     * @param string $relatedType
     * @param int$relatedId
     * @throws RuntimeException
     */
    public function __construct($relatedType, $relatedId)
    {
        switch($relatedType) {
            case self::RELATED_TYPE_DASHBOARD:
            case self::RELATED_TYPE_THIRD:
            case self::RELATED_TYPE_PEOPLE:
            case self::RELATED_TYPE_OPPORTUNITY:
            case self::RELATED_TYPE_ITEM:
            case self::RELATED_TYPE_TASK:
            case self::RELATED_TYPE_DOCUMENT:
                $this->relatedType = $relatedType;
                break;
            default:
                throw new RuntimeException(sprintf('Invalid related type "%s" provide ; please use RELATED_TYPE_* constant provide by class %s.', $relatedType, static::class));
        }

        $this->relatedId = $relatedId;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return array(
            'search' => array(
                'id' => $this->relatedId,
                'type' => $this->relatedType
            )
        );
    }
} 