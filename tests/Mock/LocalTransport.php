<?php

namespace Sellsy\Tests\Mock;

use Sellsy\Transports\TransportInterface;

/**
 * Class LocalTransport
 *
 * @package Sellsy\Tests\Mock
 */
class LocalTransport implements TransportInterface
{
    /**
     * @var string
     */
    protected $basePath;

    /**
     * @var TransportInterface
     */
    protected $realTransport;

    /**
     * LocalTransport constructor.
     */
    public function __construct()
    {
        $this->basePath = dirname(__DIR__) . '/Data';
    }

    /**
     * @param TransportInterface $realTransport
     */
    public function setRealTransport(TransportInterface $realTransport)
    {
        $this->realTransport = $realTransport;
    }

    /**
     * @param array $requestSettings
     * @return array
     * @throws \Sellsy\Exception\ServerException
     */
    public function call(array $requestSettings)
    {
        $path = $this->getLocalFileName($requestSettings);

        if (file_exists($path)) {
            return json_decode(file_get_contents($path), true);
        }

        if ($this->realTransport) {
            $array = $this->realTransport->call($requestSettings);
            $directory = dirname($path);

            if (! is_dir($directory) && ! mkdir($directory, 0755, true)) {
                throw new \RuntimeException("Unable create directory " . $directory);
            }

            if (! file_put_contents($path, $this->getAnonymizeJson($array))) {
                throw new \RuntimeException("Unable to save data file " . $path);
            }

            return $array;
        }

        throw new \RuntimeException("Unable to find the data file " . $path);
    }

    /**
     * @param array $data
     * @return string
     */
    protected function getAnonymizeJson(array $data)
    {
        // Anonymize data
        array_walk_recursive($data['response'], function(&$value, $key) {
            switch(true) {
                case $value === 'Y' :
                case $value === 'y' :
                case $value === 'N' :
                case $value === 'n' :
                case is_numeric($value) :
                case strtotime($value) :
                    return false;
            }

            $value = $key . '_value';
        });

        return json_encode($data);
    }

    /**
     * @param array $requestSettings
     * @return string
     */
    protected function getLocalFileName(array $requestSettings)
    {
        $fileName = str_replace('.', '/', $requestSettings['method']);

        array_walk_recursive($requestSettings['params'], function($value, $key) use(&$fileName) {
            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }

            $fileName .= sprintf('/%s/%s', $key, $value);
        });

        $fileName = sprintf('%s/data.json', $fileName);

        return sprintf('%s/%s', $this->basePath, $fileName);
    }
}
