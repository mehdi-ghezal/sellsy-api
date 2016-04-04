<?php

namespace Sellsy\Criteria\Annotations;

use Sellsy\Criteria\CriteriaInterface;

/**
 * Class SearchAnnotationsCriteria
 *
 * @package Sellsy\Criteria\Annotations
 */
class SearchAnnotationsCriteria implements CriteriaInterface
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var int
     */
    protected $id;

    /**
     * SearchAnnotationsCriteria constructor.
     *
     * @param string $type
     * @param int $id
     */
    public function __construct($type, $id)
    {
        $this->type = $type;
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return array(
            'search' => array(
                'id' => $this->id,
                'type' => $this->type
            )
        );
    }
} 