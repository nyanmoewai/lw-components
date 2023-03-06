<?php

/**
 * https://mlocati.github.io/php-cs-fixer-configurator/#version:3.4
 */

$configs = [
    '@PSR2' => true,
    'array_syntax' => ['syntax' => 'short'],
    'no_unused_imports' => true,
    'ordered_imports' => [
        'sort_algorithm' => 'alpha'
    ],
    'whitespace_after_comma_in_array' => true,
    'binary_operator_spaces' => true,
    'blank_line_after_namespace' => true,
    'blank_line_before_statement' => true,
    'array_indentation' => true,
    'phpdoc_align' => true,
    'method_chaining_indentation' => true,
    'phpdoc_annotation_without_dot' => true
];

return (new PhpCsFixer\Config)->setRules($configs);
