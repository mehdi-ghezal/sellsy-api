<?php

namespace Sellsy\Mappers;

use Sellsy\Exception\RuntimeException;
use Sellsy\ExpressionLanguage\ExpressionLanguage;
use Sellsy\Models\SmartTags\TagInterface;
use Sellsy\Models\CustomFields\CustomFieldInterface;
use Sellsy\Mappers\YmlMapper\MappingsParser;
use Symfony\Component\ExpressionLanguage\SyntaxError;

/**
 * Class YmlMapper
 *
 * @package Sellsy\Mappers
 */
class YmlMapper extends AbstractMapper
{
    /**
     * @var ExpressionLanguage
     */
    protected $expressionLanguage;

    /**
     * @var array
     */
    protected $mappings;

    /**
     * YmlMapper constructor.
     *
     * @param string|null $path Optional. Path of file or directory containing mappings information in YAML
     */
    public function __construct($path = null)
    {
        parent::__construct();

        $parser = new MappingsParser($this->logger);

        $this->interfacesMappings = $this->getDefaultInterfacesMappings();
        $this->mappings = $parser->parse($path ?: realpath(dirname(__DIR__) . '/Mappings'));

        $this->expressionLanguage = new ExpressionLanguage();
    }

    /**
     * @inheritdoc
     */
    public function mapObject($interface, $context, array $data)
    {
        if (! isset($this->mappings[$interface][$context])) {
            throw new RuntimeException(sprintf("Unable to find a valid mapping for interface %s in context %s", $interface, $context));
        }

        return $this->_mapObject($interface, $data, $this->mappings[$interface][$context]);
    }

    /**
     * @param $interface
     * @param array $data
     * @param array|null $mappings
     * @return mixed
     * @throws RuntimeException
     */
    protected function _mapObject($interface, array $data, array $mappings)
    {
        $object = $this->getObjectInstance($interface);
        $reflectionObject = new \ReflectionObject($object);

        $this->logger->debug(sprintf('Map object %s from interface %s', $reflectionObject->getNamespaceName(), $interface), array(
            'data' => $data,
            'mappings' => $mappings
        ));

        foreach($mappings as $attribute => $definition) {
            $property = $reflectionObject->getProperty($attribute);

            if ($property->isPrivate() || $property->isProtected()) {
                $property->setAccessible(true);
            }

            $value = $this->getAttributeValue($attribute, $definition, $data);
            $property->setValue($object, $value);

            $this->logger->debug(sprintf('Set attribute %s value ', $attribute), array(
                'value' => $value,
            ));
        }

        return $object;
    }

    /**
     * @param string $attribute
     * @param string $definition
     * @param array $data
     * @return null|string
     */
    protected function getAttributeValue($attribute, $definition, array $data)
    {
        // Definition is a string (ie. string expression) ; it's a scalar attribute
        if (is_string($definition)) {
            $this->logger->debug(sprintf('Get scalar value for attribute %s', $attribute), array(
                'expression' => $definition,
                'data' => $data
            ));

            return $this->evaluate($definition, $data);
        }

        // Linked object
        if (is_array($definition) && (!isset($definition['collection']) || !$definition['collection'])) {
            $this->logger->debug(sprintf('Get linked object for attribute %s', $attribute), array(
                'expression' => $definition,
                'data' => $data
            ));

            return $this->_mapObject($definition['type'], $data, $definition['mappings']);
        }

        // Linked collection of objects
        if (is_array($definition) && isset($definition['collection']) && $definition['collection']) {
            $this->logger->debug(sprintf('Get linked collection of objects for attribute %s', $attribute), array(
                'expression' => $definition,
                'data' => $data
            ));

            $value = array();

            // Multiple item collection
            if (isset($definition['origin'])) {
                $collectionData = $this->evaluate($definition['origin'], $data);

                // Manage special response format for SmartTags
                // TODO : Find a way to handle this case more nicely
                if ($definition['type'] == TagInterface::class && is_array($collectionData)) {
                    $collectionData = isset($collectionData[0]) ? current($collectionData) : $collectionData;
                }

                // Manage special response format for CustomFields in Document.getOne
                // TODO : Find a way to handle this case more nicely
                if ($definition['type'] == CustomFieldInterface::class && $definition['origin'] == 'customfieldsGroups') {
                    $collectionDataByGroups = array_column($collectionData, 'list');

                    $collectionData = array();

                    foreach($collectionDataByGroups as $collectionDataForOneGroup) {
                        $collectionData = $collectionDataForOneGroup + $collectionData;
                    }
                }

                if (is_array($collectionData)) {
                    foreach($collectionData as $collectionDataValue) {
                        if (is_array($collectionDataValue)) {
                            $value[] = $this->_mapObject($definition['type'], $collectionDataValue, $definition['mappings']);
                        }
                    }
                }
            }

            // Single item collection
            else {
                $value[] = $this->_mapObject($definition['type'], $data, $definition['mappings']);
            }

            return $value;
        }

        return null;
    }

    /**
     * @param string $expression
     * @param array $data
     * @param mixed|null $default
     * @return bool|\DateTime|int|null|string
     */
    protected function evaluate($expression, array $data, $default = null)
    {
        try {
            $this->logger->debug(sprintf('Evaluate expression %s', $expression), array(
                'data' => $data,
                'default' => $default
            ));

            return $this->expressionLanguage->evaluate($expression, $data);
        }
        catch(SyntaxError $e) {
            return $default;
        }
    }
}
