<?php

namespace Sellsy\Mappers;

use Minime\Annotations\Reader;
use Sellsy\Collection\Collection;

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
     * @param object $object The object or the collection to map
     * @param object $response
     * @return object The mapped object or collection
     */
    public function map($object, $response)
    {
        if ($object instanceof Collection) {
            return $this->mapCollection($object, $response);
        }

        return $this->mapObject($object, $response);
    }

    /**
     * @param object $object
     * @param object $response
     * @return object The mapped object
     */
    protected function mapObject($object, $response)
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
     * @param Collection $collection
     * @param object $response
     * @return object The mapped collection of objects
     */
    protected function mapCollection(Collection $collection, $response)
    {
        $object = $collection->createCollectionItem();

        foreach($response->result as $result) {
            $collection->push($this->mapObject($object, $result));
        }

        return $collection;
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