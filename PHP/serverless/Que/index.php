<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

return function ($event) {
    var_dump('Hello ' . ($event['body'] ?? 'world'));
};
