<?php

namespace Sellsy\ExpressionLanguage\Provider;

use Symfony\Component\ExpressionLanguage\ExpressionFunction;
use Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;

/**
 * Class StringExpressionLanguageProvider
 *
 * @package Sellsy\ExpressionLanguage\Provider
 */
class StringExpressionLanguageProvider implements ExpressionFunctionProviderInterface
{
    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            $this->parseBooleanFunction(),
            $this->parseNumberFunction(),
            $this->parseUrlFunction(),
        );
    }

    /**
     * @return ExpressionFunction
     */
    protected function parseBooleanFunction()
    {
        $compiler = function($string) {
            $compiled = 'if (is_bool(%1$s)) {';
            $compiled.= 'return %1$s;';
            $compiled.= '}';
            $compiled.= 'if (is_numeric(%1$s)) {';
            $compiled.= 'return %1$s > 0;';
            $compiled.= '}';
            $compiled.= 'if (is_string(%1$s)) {';
            $compiled.= '%1$s = strtolower(%1$s);';
            $compiled.= 'if (%1$s === "y" || %1$s === "true") {';
            $compiled.= 'return true;';
            $compiled.= '}';
            $compiled.= 'if (%1$s === "n" || %1$s === "false") {';
            $compiled.= 'return false;';
            $compiled.= '}';
            $compiled.= '}';
            $compiled.= 'return null;';

            return sprintf($compiled, $string);
        };

        $evaluator = function(array $values, $string) {
            if (is_bool($string)) {
                return $string;
            }

            if (is_numeric($string)) {
                return $string > 0;
            }

            if (is_string($string)) {
                $string = strtolower($string);

                if ($string === 'y' || $string === 'true') {
                    return true;
                }

                if ($string === 'n' || $string === 'false') {
                    return false;
                }
            }

            return null;
        };

        return new ExpressionFunction('boolean', $compiler, $evaluator);
    }

    /**
     * @return ExpressionFunction
     */
    protected function parseNumberFunction()
    {
        $compiler = function($string) {
            $compiled = 'if (is_numeric($string)) {';
            $compiled.= 'return $string + 0;';
            $compiled.= '}';
            $compiled.= 'return null;';

            return sprintf($compiled, $string);
        };

        $evaluator = function(array $values, $string) {
            if (is_numeric($string)) {
                return $string + 0;
            }

            return null;
        };

        return new ExpressionFunction('number', $compiler, $evaluator);
    }

    /**
     * @return ExpressionFunction
     */
    protected function parseUrlFunction()
    {
        $compiler = function($string) {
            $compiled = 'if (strpos(%1$s, \'?\') === 0) {';
            $compiled.= 'return \'https://www.sellsy.fr/\' . %1$s;';
            $compiled.= '}';
            $compiled.= 'return null;';

            return sprintf($compiled, $string);
        };

        $evaluator = function(array $values, $string) {
            if (strpos($string, '?') === 0) {
                return 'https://www.sellsy.fr/' . $string;
            }

            return null;
        };

        return new ExpressionFunction('url', $compiler, $evaluator);
    }
}