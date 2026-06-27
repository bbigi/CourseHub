<?php

$writablePath = getenv('WRITABLE_PATH') ?: '/tmp/coursehub-writable';

$directories = [
    $writablePath,
    $writablePath . '/cache',
    $writablePath . '/logs',
    $writablePath . '/session',
    $writablePath . '/uploads',
];

foreach ($directories as $directory) {
    if (! is_dir($directory)) {
        mkdir($directory, 0777, true);
    }
}

require __DIR__ . '/../public/index.php';