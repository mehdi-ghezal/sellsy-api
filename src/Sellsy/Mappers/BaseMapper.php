<?php

namespace Sellsy\Mappers;

use Minime\Annotations\Reader;

/**
 * Class BaseMapper
 * @package Sellsy\Mappers
 */
class BaseMapper
{
    /**
     * @var Reader
     */
    protected $reader;

    /**
     * @param Reader $reader
     */
    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * @param object $object
     * @param object $response
     * @return object The mapped object
     */
    public function map($object, $response)
    {
        $class = get_class($object);

        foreach(array_keys(get_class_vars($class)) as $property) {
            $propertyAnnotation = $this->reader->getPropertyAnnotations($class, $property);

            $key = $propertyAnnotation->get('copy');
            $key = $key === true ? $property : $key;

            if (! $key) {
                continue;
            }

            $object->$property = $this->extractData($key, $response);

            $convert = $propertyAnnotation->get('convert');

            switch($convert) {
                case 'boolean' :
                    $object->$property = $object->$property === "Y" || $object->$property === "y";
                    break;
            }
        }

        return $object;
    }

    /**
     * @param $key
     * @param $response
     * @return mixed
     */
    protected function extractData($key, $response)
    {
        if (strpos($key, '.') === false) {
            return $response->$key;
        }

        foreach(explode('.', $key) as $keyPart) {
            $response = $response->$keyPart;
        }

        return $response;
    }
}