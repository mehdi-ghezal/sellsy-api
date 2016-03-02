<?php

namespace Sellsy\Mappers;

use Minime\Annotations\Reader;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\ExpressionLanguage\SyntaxError;


/**
 * Class MinimeMapper
 * @package Sellsy\Mappers
 */
class MinimeMapper extends AbstractMapper
{
    /**
     * @var Reader
     */
    protected $reader;

    /**
     * @var ExpressionLanguage
     */
    protected $expressionLanguage;

    /**
     * MinimeMapper constructor.
     *
     * @param Reader $reader
     * @param array $interfacesMappings
     */
    public function __construct(Reader $reader, array $interfacesMappings = array())
    {
        $this->reader = $reader;
        $this->interfacesMappings = $this->getDefaultInterfacesMappings();

        foreach($interfacesMappings as $interface => $class) {
            $this->setInterfaceMapping($interface, $class);
        }

        $this->expressionLanguage = new ExpressionLanguage();
    }

    /**
     * @param $interface
     * @param array $data
     * @return object
     * @throws RuntimeException
     */
    public function mapObject($interface, array $data)
    {
        $interface = ltrim($interface, '\\');

        $objectFactory = new \ReflectionClass($this->interfacesMappings[$interface]);
        $object = $objectFactory->newInstanceWithoutConstructor();

        $objectReflection = new \ReflectionObject($object);

        $data = $this->prepareData($data);

        /** @var \ReflectionProperty $property */
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
                $property->setValue($object, $this->extractData($translations, $data));
                continue;
            }

            // Get the type of target property
            $type = $propertyAnnotation->get('var');

            // Case 2: Copy of many attributes inside the property as an associative array
            if (is_object($translations) && strtolower($type) == 'array') {
                $propertyValue = array();

                foreach($translations as $origin => $target) {
                    $propertyValue[$target] = $this->extractData($origin, $data);
                }

                $property->setValue($object, $propertyValue);
                continue;
            }

            // Case 3: Copy of many attributes inside the property as a collection of objects
            if (is_object($translations) && strpos($type, '[]') !== false) {
                $propertyValues = array();

                // Extract collection translations and data
                $collectionOrigin = key($translations);
                $collectionTranslations = current($translations);
                $collectionDataList = $this->extractData($collectionOrigin, $data);

                foreach($collectionDataList as $collectionData) {
                    if (is_array($collectionData)) {
                        $newInstanceData = $this->extractDataObject($collectionData, $collectionTranslations);

                        $propertyValues[] = $this->mapObject(str_replace('[]', '', $type), $newInstanceData);
                    }
                }

                $property->setValue($object, $propertyValues);
                continue;
            }

            // Case 4: Copy of many attributes inside the property as an object
            if (is_object($translations)) {
                // Map our property, ie. the new instance just created
                $dataForProperty = $this->extractDataObject($data, $translations);
                $propertyValue = $this->mapObject($type, $dataForProperty);

                // Set the property
                $property->setValue($object, $propertyValue);
                continue;
            }

            throw new RuntimeException(sprintf('Unable to map property %s', $property->getName()));
        }

        return $object;
    }

    /**
     * @param $expression
     * @param array $data
     * @return array|bool|\DateTime|int|null|string
     */
    protected function extractData($expression, array $data)
    {
        try {
            $data = $this->expressionLanguage->evaluate($expression, $data);

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
        catch(SyntaxError $e) {}

        return null;
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
            $targetData[$target] = $this->extractData($origin, $data);
        }

        return $targetData;
    }

    /**
     * Convert full array of array of object
     *
     * @param array $data
     * @return array
     */
    protected function prepareData(array $data)
    {
        foreach($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = json_decode(json_encode($value));
            }
        }

        return $data;
    }
}
