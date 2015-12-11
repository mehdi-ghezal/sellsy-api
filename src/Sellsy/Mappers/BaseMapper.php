<?php

namespace Sellsy\Mappers;

use Minime\Annotations\Reader;
use Sellsy\Collections\Collection;
use Sellsy\Exception\RuntimeException;

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

            // The property value is a related object, we handle it
            if (is_object($object->$property)) {
                $data = $response;

                // Mapping of response data
                if (is_object($key)) {
                    $data = new \stdClass();

                    foreach($key as $origin => $target) {
                        $data->$target = $this->extractData($origin, $response);
                    }
                }

                $object->$property = $this->mapObject($object->$property, $data);
                continue;
            }

            // The property value is not an object (ie. previous if) ; we check that the key is not an object
            if (is_object($key)) {
                throw new RuntimeException(sprintf("The @copy annotation is an object, property %s have to be an object too", $property));
            }

            $object->$property = $this->extractData($key, $response);

            $convert = $propertyAnnotation->get('convert');

            switch($convert) {
                case 'boolean' :
                    $object->$property = $object->$property === "Y" || $object->$property === "y";
                    break;
                case 'float' :
                    $object->$property = filter_var($object->$property, FILTER_VALIDATE_FLOAT);
                    break;
                case 'date' :
                    $object->$property = new \DateTime($object->$property);
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
        foreach($response->result as $result) {
            $collection->push($this->mapObject($collection->createCollectionItem(), $result));
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
            return isset($response->$key) ? $response->$key : null;
        }

        foreach(explode('.', $key) as $keyPart) {
            $response = isset($response->$keyPart) ? $response->$keyPart : null;
        }

        return $response;
    }
}