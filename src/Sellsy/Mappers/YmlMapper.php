<?php

namespace Sellsy\Mappers;

use Sellsy\Exception\RuntimeException;
use Sellsy\ExpressionLanguage\ExpressionLanguage;
use Sellsy\Models\SmartTags\TagInterface;
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
    public function mapObject($interface, array $data)
    {
        if (! isset($this->mappings[$interface])) {
            throw new RuntimeException("Unable to find a valid mapping for interface " . $interface);
        }

        return $this->_mapObject($interface, $data, $this->mappings[$interface]);
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

        foreach($mappings as $attribute => $expression) {
            $property = $reflectionObject->getProperty($attribute);

            if ($property->isPrivate() || $property->isProtected()) {
                $property->setAccessible(true);
            }

            $value = $this->getAttributeValue($attribute, $expression, $data);
            $property->setValue($object, $value);

            $this->logger->debug(sprintf('Set attribute %s value ', $attribute), array(
                'value' => $value,
            ));
        }

        return $object;
    }

    /**
     * @param string $attribute
     * @param string $expression
     * @param array $data
     * @return null|string
     */
    protected function getAttributeValue($attribute, $expression, array $data)
    {
        // Simple scalar attribute
        if (is_string($expression)) {
            $this->logger->debug(sprintf('Get scalar value for attribute %s', $attribute), array(
                'expression' => $expression,
                'data' => $data
            ));

            return $this->evaluate($expression, $data);
        }

        // Linked object
        if (is_array($expression) && (!isset($expression['collection']) || !$expression['collection'])) {
            $this->logger->debug(sprintf('Get linked object for attribute %s', $attribute), array(
                'expression' => $expression,
                'data' => $data
            ));

            return $this->_mapObject($expression['type'], $data, $expression['mappings']);
        }

        // Linked collection of objects
        if (is_array($expression) && isset($expression['collection']) && $expression['collection']) {
            $this->logger->debug(sprintf('Get linked collection of objects for attribute %s', $attribute), array(
                'expression' => $expression,
                'data' => $data
            ));

            $value = array();

            // Multiple item collection
            if (isset($expression['origin'])) {
                $collectionData = $this->evaluate($expression['origin'], $data);

                // Manage special response format for SmartTags
                if ($expression['type'] == TagInterface::class) {
                    $collectionData = is_array($collectionData) ? current($collectionData) : $collectionData;
                }

                if (is_array($collectionData)) {
                    foreach($collectionData as $collectionDataValue) {
                        if (is_array($collectionDataValue)) {
                            $value[] = $this->_mapObject($expression['type'], $collectionDataValue, $expression['mappings']);
                        }
                    }
                }
            }

            // Single item collection
            else {
                $value[] = $this->_mapObject($expression['type'], $data, $expression['mappings']);
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
