<?php
/*
 * This document has been generated with
 * https://mlocati.github.io/php-cs-fixer-configurator/#version:3.0.0|configurator
 * you can change this configuration by importing this file.
 */
$config = new PhpCsFixer\Config();
return $config
    ->setRiskyAllowed(true)
    ->setRules([
        "@PhpCsFixer" => true,
        "@PSR12" => true,
        "@PSR2" => true,
        "@Symfony" => true,
        "multiline_whitespace_before_semicolons" => true,
        "no_superfluous_phpdoc_tags" => false,
        "phpdoc_align" => true,
        "phpdoc_separation" => true,
        "concat_space" => [
            "spacing" => "one"
        ]
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
        ->exclude('vendor')
        ->in(__DIR__)
    )
;
