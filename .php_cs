<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src');

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR2' => true,
        'array_syntax' => ['syntax' => 'short'],
        'heredoc_to_nowdoc' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'ordered_imports' => true,
        'phpdoc_add_missing_param_annotation' => true,
        'psr4' => true,
    ])
    ->setFinder($finder);
