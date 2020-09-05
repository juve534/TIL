<?php
$finder = PhpCsFixer\Finder::create()
    ->exclude('bootstrap/cache')
    ->exclude('storage')
    ->exclude('vendor')
    ->exclude('PF_SDK')
    ->in(__DIR__)
    ->name('*.php')
    ->notName('*.blade.php')
    ->notName('_ide_helper.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);
return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
        '@Symfony' => true,
        'array_indentation' => true,
        'array_syntax' => ['syntax' => 'short'],
        'binary_operator_spaces' => ['align_double_arrow' => true],
        'compact_nullable_typehint' => true,
        'concat_space' => ['spacing' => 'one'],
        'increment_style' => ['style' => 'post'],
        'list_syntax' => ['syntax' => 'short'],
        'method_chaining_indentation' => true,
        'no_empty_comment' => false,
        'no_extra_blank_lines' => false,
        'phpdoc_no_empty_return' => false,
        'phpdoc_order' => true,
        'yoda_style' => false,
    ])
    ->setFinder($finder);