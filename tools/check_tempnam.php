<?php

$dir = realpath(__DIR__.'/../storage/views') ?: __DIR__.'/../storage/views';

echo 'dir='.$dir.PHP_EOL;
echo 'dir_exists='.(is_dir($dir) ? '1' : '0').PHP_EOL;
echo 'writable='.(is_writable($dir) ? '1' : '0').PHP_EOL;

$prefixes = [
    'test',
    'dda9c69fc81f44b0a91fd00fb8511841.php',
];

foreach ($prefixes as $prefix) {
    echo 'prefix='.$prefix.PHP_EOL;
    $file = @tempnam($dir, $prefix);
    var_dump($file);

    if ($file !== false && file_exists($file)) {
        unlink($file);
    }
}
