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
     * Parser constructor.
     */
    public function __construct()
    {
        $this->parser = new Yaml();
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

        return $mappings;
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

            if (strpos($value, '.') !== false) {
                $value = explode('.', $value);
                $value = join("']['", $value);
                $value .= "']";

                $value = substr_replace($value, '', strpos($value, ']') - 1, 2);
            }
        });

        return $mappings;
    }
}
