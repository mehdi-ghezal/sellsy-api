<?php

namespace Sellsy\Mappers;

use Minime\Annotations\Reader;
use Sellsy\Interfaces\MapperInterface;

/**
 * Class MinimeMapper
 * @package Sellsy\Mappers
 */
class MinimeMapper implements MapperInterface
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
     * @param $object
     * @param array $data
     * @return mixed
     */
    public function mapObject($object, array $data)
    {
        $objectReflection = new \ReflectionObject($object);

        foreach($objectReflection->getProperties() as $property) {
            $propertyAnnotation = $this->reader->getPropertyAnnotations($objectReflection->getName(), $property->getName());

            // Skip static property
            if ($property->isStatic()) {
                continue;
            }

            // Unlock property if need
            if ($property->isPrivate() || $property->isProtected()) {
                $property->setAccessible(true);
            }

            $translations = $propertyAnnotation->get('copy');
            $translations = $translations === true ? $property->getName() : $translations;

            // Case 1: Copy of scalar value inside the property
            if (is_scalar($translations)) {
                $property->setValue($object, $this->extractData($data, $translations));
                continue;
            }

            // Get the type of target property
            $type = $propertyAnnotation->get('var');

            // Case 2: Copy of many attributes inside the property as an associative array
            if (is_object($translations) && strtolower($type) == 'array') {
                $propertyValue = array();

                foreach($translations as $origin => $target) {
                    $propertyValue[$target] = $this->extractData($data, $origin);
                }

                $property->setValue($object, $propertyValue);
                continue;
            }

            // Case 3: Copy of many attributes inside the property as a collection of objects
            if (is_object($translations) && strpos($type, '[]') !== false) {
                $reflectionClass = new \ReflectionClass(str_replace('[]', '', $type));
                $propertyValues = array();

                // Extract collection translations and data
                $collectionOrigin = key($translations);
                $collectionTranslations = current($translations);
                $collectionDataList = $this->extractData($data, $collectionOrigin);

                foreach($collectionDataList as $collectionData) {
                    if (is_array($collectionData)) {
                        $newInstance = $reflectionClass->newInstanceWithoutConstructor();
                        $newInstanceData = $this->extractDataObject($collectionData, $collectionTranslations);

                        $propertyValues[] = $this->mapObject($newInstance, $newInstanceData);
                    }
                }

                $property->setValue($object, $propertyValues);
                continue;
            }

            // Case 4: Copy of many attributes inside the property as an object
            if (is_object($translations)) {
                // Create an instance of our property
                $reflectionClass = new \ReflectionClass($type);
                $propertyValue = $reflectionClass->newInstanceWithoutConstructor();

                // Map our property, ie. the new instance just created
                $dataForProperty = $this->extractDataObject($data, $translations);
                $propertyValue = $this->mapObject($propertyValue, $dataForProperty);

                // Set the property
                $property->setValue($object, $propertyValue);
                continue;
            }
        }

        return $object;
    }

    /**
     * @param array $data
     * @param $path
     * @return mixed
     */
    protected function extractData(array $data, $path)
    {
        $extractedData = null;

        foreach(explode('.', $path) as $keyPart) {
            $extractedData = isset($data[$keyPart]) ? $data[$keyPart] : null;
        }

        return $this->castData($extractedData);
    }

    /**
     * @param mixed $data
     * @return mixed
     */
    protected function castData($data)
    {
        if (! is_scalar($data)) {
            return $data;
        }

        if ($data === 'Y') {
            return true;
        }

        if ($data === 'N') {
            return false;
        }

        if (is_numeric($data)) {
            return $data + 0;
        }

        if (strtotime($data)) {
            return new \DateTime($data);
        }

        return $data;
    }

    /**
     * @param array $data
     * @param $translations
     * @return array
     */
    protected function extractDataObject(array $data, $translations)
    {
        $targetData = array();

        foreach($translations as $origin => $target) {
            $targetData[$target] = $this->extractData($data, $origin);
        }

        return $targetData;
    }
}
