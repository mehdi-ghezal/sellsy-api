<?php

namespace Sellsy\Mappers;

use Sellsy\Exception\RuntimeException;
use Sellsy\Mappers\YmlMapper\MappingsParser;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\ExpressionLanguage\SyntaxError;

use Sellsy\Models\SmartTags\TagInterface;

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
        $parser = new MappingsParser();

        $path = $path ? $path : realpath(dirname(__DIR__) . '/Mappings');

        $this->mappings = $parser->parse($path);
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

        foreach($mappings as $attribute => $expression) {
            $property = $reflectionObject->getProperty($attribute);

            if ($property->isPrivate() || $property->isProtected()) {
                $property->setAccessible(true);
            }

            $property->setValue($object, $this->getAttributeValue($expression, $data));
        }

        return $object;
    }

    /**
     * @param $expression
     * @param array $data
     * @return null|string
     */
    protected function getAttributeValue($expression, array $data)
    {
        // Simple scalar attribute
        if (is_string($expression)) {
            try {
                $value = $this->expressionLanguage->evaluate($expression, $data);

                if (strtoupper($value) === 'Y') {
                    return true;
                }

                if (strtoupper($value) === 'N') {
                    return false;
                }

                if (is_numeric($value)) {
                    return $value + 0;
                }

                if (strtotime($value) > 0 && preg_match('/^20[0-9]{2}/', $value)) {
                    return new \DateTime($value);
                }

                return $value;
            }
            catch(SyntaxError $e) {
                return null;
            }
        }

        // Linked object
        if (is_array($expression) && (!isset($expression['collection']) || !$expression['collection'])) {
            return $this->_mapObject($expression['type'], $data, $expression['mappings']);
        }

        // Linked collection of objects
        if (is_array($expression) && isset($expression['collection']) && $expression['collection']) {
            $value = array();

            // Multiple item collection
            if (isset($expression['origin'])) {
                $collectionData = $this->expressionLanguage->evaluate($expression['origin'], $data);

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
}
