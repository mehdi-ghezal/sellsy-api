<?php

namespace Sellsy\ExpressionLanguage;

use Symfony\Component\ExpressionLanguage\ParserCache\ParserCacheInterface;
use Sellsy\ExpressionLanguage\Provider\DateTimeExpressionLanguageProvider;
use Sellsy\ExpressionLanguage\Provider\StringExpressionLanguageProvider;

/**
 * Class ExpressionLanguage
 *
 * @package Sellsy\ExpressionLanguage
 */
class ExpressionLanguage extends \Symfony\Component\ExpressionLanguage\ExpressionLanguage
{
    /**
     * @inheritdoc
     */
    public function __construct(ParserCacheInterface $cache = null, array $providers = array())
    {
        array_unshift($providers, new StringExpressionLanguageProvider());
        array_unshift($providers, new DateTimeExpressionLanguageProvider());

        parent::__construct($cache, $providers);
    }
}