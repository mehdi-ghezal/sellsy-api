<?php

namespace Sellsy\Criteria\Client;

use Sellsy\Criteria\Generic\GetListCriteria;
use Sellsy\Exception\RuntimeException;

/**
 * Class SearchCustomersCriteria
 * @package Sellsy\Criteria\Client
 */
class SearchCustomersCriteria extends GetListCriteria
{
    /**
     * @var string
     */
    const TYPE_COMPANY = 'corporation';

    /**
     * @var string
     */
    const TYPE_PERSON = 'person';

    /**
     * @var string
     */
    protected $type;

    /**
     * @param string $type
     * @return $this
     * @throws RuntimeException
     */
    public function setType($type)
    {
        switch($type) {
            case self::TYPE_COMPANY:
            case self::TYPE_PERSON:
                $this->type = $type;
                break;
            default:
                throw new RuntimeException(sprintf('Invalid type "%s" provide ; please use TYPE_* constant provide by class %s.', $type, self::class));
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        // Initialize parameters
        $parameters = array(
            'search' => array()
        );

        if ($this->type) {
            $parameters['search']['type'] = $this->type;
        }

        if ($this->tags) {
            $parameters['search']['tags'] = implode(',', $this->tags);
        }

        // Cleaning parameters
        if (! count($parameters['search'])) {
            unset($parameters['search']);
        }

        return $parameters;
    }
} 