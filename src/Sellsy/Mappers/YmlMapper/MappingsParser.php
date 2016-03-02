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
     * Parser constructor.
     */
    public function __construct()
    {
        $this->parser = new Yaml();
        $this->useToProcess = array();
    }

    public function parse($path)
    {
        if (is_file($path)) {
            return $this->parseFile($path);
        }

        $mappings = array();

        $directories = new \RecursiveDirectoryIterator($path, \FilesystemIterator::SKIP_DOTS);
        $files = new \RecursiveIteratorIterator($directories, \RecursiveIteratorIterator::SELF_FIRST);

        /** @var \SplFileInfo $file */
        foreach($files as $file) {
            if (! $file->isFile()) {
                continue;
            }

            $mappings = array_merge($mappings, $this->parseFile($file->getPathname()));
        }

        return $this->postProcessUse($mappings);
    }

    /**
     * @param $fileName
     * @return mixed
     */
    protected function parseFile($fileName)
    {
        $mappings = $this->parser->parse(file_get_contents($fileName));

        // Manage default value and syntax replacement
        array_walk_recursive($mappings, function(&$value, $key) {
            if (is_null($value)) {
                $value = $key;
            }

            $value = str_replace('\.', '####____####', $value);

            if (strpos($value, '.') !== false) {
                $value = explode('.', $value);
                $value = join("']['", $value);
                $value .= "']";

                $value = substr_replace($value, '', strpos($value, ']') - 1, 2);
            }

            $value = str_replace('####____####', '.', $value);
        });

        // Manage use and attributes statements
        foreach($mappings as $interface => &$mapping) {
            if (isset($mapping['use'])) {
                $this->useToProcess[$interface] = array();

                foreach($mapping['use'] as $useInterface) {
                    $this->useToProcess[$interface][] = $useInterface;
                }

                unset($mapping['use']);
            }

            if (isset($mapping['attributes'])) {
                $attributes = $mapping['attributes'];
                unset($mapping['attributes']);
                $mapping = $attributes;
            }
        }

        return $mappings;
    }

    /**
     * @param array $mappings
     * @return array
     */
    protected function postProcessUse(array $mappings)
    {
        foreach($this->useToProcess as $baseInterface => $useInterfaces) {
            foreach($useInterfaces as $useInterface) {
                $mergedMapping = array_replace_recursive($mappings[$useInterface], $mappings[$baseInterface]);
                $mappings[$baseInterface] = $mergedMapping;
            }
        }

        return $mappings;
    }
}
