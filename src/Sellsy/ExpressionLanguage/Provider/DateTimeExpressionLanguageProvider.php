<?php

namespace Sellsy\ExpressionLanguage\Provider;

use Symfony\Component\ExpressionLanguage\ExpressionFunction;
use Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;

/**
 * Class DateTimeExpressionLanguageProvider
 *
 * @package Sellsy\ExpressionLanguage\Provider
 */
class DateTimeExpressionLanguageProvider implements ExpressionFunctionProviderInterface
{
    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            $this->parseTimestampFunction(),
            $this->parseDateTimeFunction(),
        );
    }

    /**
     * @return ExpressionFunction
     */
    protected function parseTimestampFunction()
    {
        $compiler = function($string) {
            return sprintf('if (%1$s) { try { return new \DateTime(\'@\' . %1$s); } catch(\Exception $e) {} } return null;', $string);
        };

        $evaluator = function(array $values, $string) {
            if ($string) {
                try {
                    return new \DateTime('@' . $string);
                }
                    // Do nothing
                catch(\Exception $e) {}
            }

            return null;
        };

        return new ExpressionFunction('parseTimestamp', $compiler, $evaluator);
    }

    /**
     * @return ExpressionFunction
     */
    protected function parseDateTimeFunction()
    {
        $compiler = function($string) {
            return sprintf('if (%1$s) { try { return new \DateTime(%1$s); } catch(\Exception $e) {} } return null;', $string);
        };

        $evaluator = function(array $values, $string) {
            if ($string) {
                try {
                    return new \DateTime($string);
                }
                    // Do nothing
                catch(\Exception $e) {}
            }

            return null;
        };

        return new ExpressionFunction('parseDateTime', $compiler, $evaluator);
    }
}