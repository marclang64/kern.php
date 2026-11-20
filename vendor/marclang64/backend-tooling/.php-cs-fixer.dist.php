<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/configs')
    ->name('*.php');

$config = require __DIR__ . '/configs/php-cs-fixer.php';

return $config->setFinder($finder);
