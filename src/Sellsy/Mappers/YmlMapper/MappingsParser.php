<?php

namespace Sellsy\Mappers\YmlMapper;

use Symfony\Component\Yaml\Yaml;

/**
 * Class MappingsParser
 *
 * @package Sellsy\Mappers\YmlMapper
 */
class MappingsParser
{
    /**
     * @var Yaml
     */
    protected $parser;

    /**
     * @var array
     */
    protected $useToProcess;

    /**
     * MappingsParser constructor.
     */
    public function __construct()
    {
        $this->parser = new Yaml();
        $this->useToProcess = array();
    }

    /**
     * @param $path
     * @return array|mixed
     */
    public function parse($path)
    {
        $mappings = array();

        if(is_dir($path)) {
            $directories = new \RecursiveDirectoryIterator($path, \FilesystemIterator::SKIP_DOTS);
            $files = new \RecursiveIteratorIterator($directories, \RecursiveIteratorIterator::SELF_FIRST);

            /** @var \SplFileInfo $file */
            foreach($files as $file) {
                if (! $file->isFile()) {
                    continue;
                }

                $mappings = array_merge($mappings, $this->parseFile($file->getPathname()));
            }
        }

        elseif (is_file($path)) {
            $mappings = $this->parseFile($path);
        }

        return $this->postProcessUse($mappings);
    }

    /**
     * @param $fileName
     * @return mixed
     */
    protected function parseFile($fileName)
    {
        $definitions = $this->parser->parse(file_get_contents($fileName));

        if (count($definitions) == 0) {
            // Erreur
        }

        if (count($definitions) > 1) {
            // Erreur
        }

        $mappings = $this->mappingsExtract($definitions);
        $mappings = $this->mappingsNormalizeSyntax($mappings);

        return $mappings;
    }

    /**
     * @param array $definitions
     * @return array
     */
    protected function mappingsExtract(array $definitions)
    {
        $mappings = array();

        $interface = current(array_keys($definitions));
        $definitions = current($definitions);

        foreach($definitions as $context => $definition) {
            // Extract context concerned
            if (isset($definition['context'])) {
                $context = is_array($definition['context']) ? $definition['context'] : array($definition['context']);
            } else {
                $context = array($context);
            }

            // Extract mappings
            if (isset($definition['mappings'])) {
                $mapping = $definition['mappings'];
            } else {
                $mapping = $definition;

                unset($mapping['context']);
                unset($mapping['use']);
            }

            // Bind mapping to context
            foreach($context as $name) {
                $mappings[$name] = $mapping;
            }

            if (isset($definition['use'])) {
                $uses = array();

                foreach($definition['use'] as $useInterface => $useContext) {
                    $uses[] = array(
                        'interface' => $useInterface,
                        'context' => $useContext
                    );
                }

                $this->useToProcess[] = array(
                    'origin' => array(
                        'interface' => $interface,
                        'context' => $context
                    ),
                    'uses' => $uses
                );
            }
        }

        // Manage default value
        array_walk_recursive($mappings, function(&$value, $key) {
            if (is_null($value)) {
                $value = $key;
            }
        });

        return array(
            $interface => $mappings
        );
    }

    /**
     * @param array $mappings
     * @return array
     */
    protected function mappingsNormalizeSyntax(array $mappings)
    {
        // Manage syntax replacement : DOT by ARRAY notation
        array_walk_recursive($mappings, function(&$value, $key) {
            $newValue = '';
            $functionsParts = preg_split('/(\(|\))/i', $value, -1, PREG_SPLIT_DELIM_CAPTURE);

            foreach($functionsParts as $part) {
                $stringContactenationParts = preg_split('/(~)/i', $part, -1, PREG_SPLIT_DELIM_CAPTURE);

                foreach($stringContactenationParts as $subpart) {
                    if (! preg_match('/^["\'].*["\']$/', $subpart) && strpos($subpart, '.') !== false) {
                        $subpart = explode('.', $subpart);
                        $subpart = join("']['", $subpart);
                        $subpart .= "']";

                        $subpart = substr_replace($subpart, '', strpos($subpart, ']') - 1, 2);
                    }

                    $newValue .= $subpart;
                }
            }

            $value = $newValue;
        });

        return $mappings;
    }

    /**
     * @param array $mappings
     * @return array
     */
    protected function postProcessUse(array $mappings)
    {
        foreach($this->useToProcess as $value) {
            $originInterface = $value['origin']['interface'];

            foreach($value['origin']['context'] as $originContext) {
                foreach($value['uses'] as $use) {
                    $useContext = $use['context'];
                    $useInterface = $use['interface'];

                    $mergedMapping = array_replace_recursive($mappings[$useInterface][$useContext], $mappings[$originInterface][$originContext]);
                    $mappings[$originInterface][$originContext] = $mergedMapping;
                }
            }
        }

        return $mappings;
    }
}
