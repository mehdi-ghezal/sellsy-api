<?php

namespace Sellsy\ExpressionLanguage;

use Symfony\Component\ExpressionLanguage\ExpressionFunction;
use Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;

/**
 * Class DateTimeExpressionLanguageProvider
 *
 * @package Sellsy\ExpressionLanguage
 */
class DateTimeExpressionLanguageProvider implements ExpressionFunctionProviderInterface
{
    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            $this->getTimestampToDateTimeFunction()
        );
    }

    /**
     * @return ExpressionFunction
     */
    protected function getTimestampToDateTimeFunction()
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

        return new ExpressionFunction('timestampToDateTime', $compiler, $evaluator);
    }
}