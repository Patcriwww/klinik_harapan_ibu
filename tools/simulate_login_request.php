<?php

require __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$request = \Illuminate\Http\Request::create('/login', 'GET');

$response = $kernel->handle($request);

echo 'STATUS='.$response->getStatusCode().PHP_EOL;
echo $response->getContent();

$kernel->terminate($request, $response);
