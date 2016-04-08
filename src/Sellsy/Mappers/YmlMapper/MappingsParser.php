<?php

namespace Sellsy\Mappers\YmlMapper;

use Psr\Log\LoggerInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Class MappingsParser
 *
 * @package Sellsy\Mappers\YmlMapper
 */
class MappingsParser
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

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
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->parser = new Yaml();
        $this->useToProcess = array();
    }

    /**
     * @param $path
     * @return array|mixed
     */
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

        // Manage default value
        array_walk_recursive($mappings, function(&$value, $key) {
            if (is_null($value)) {
                $value = $key;
            }
        });

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
