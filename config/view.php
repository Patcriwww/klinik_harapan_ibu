<?php

use Illuminate\Support\Str;

$compiledPath = env('VIEW_COMPILED_PATH');

if (! $compiledPath) {
    $compiledPath = sys_get_temp_dir().DIRECTORY_SEPARATOR.'klinik_harapan_ibu_views';
}

if (! Str::startsWith($compiledPath, ['/', '\\']) && ! preg_match('/^[A-Za-z]:[\/\\\\]/', $compiledPath)) {
    $compiledPath = base_path($compiledPath);
}

if (! is_dir($compiledPath)) {
    mkdir($compiledPath, 0777, true);
}

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    */

    'paths' => [
        resource_path('views'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    |
    | Use a shorter local path on Windows to avoid tempnam() falling back to
    | the system temp directory when Blade compiles views.
    |
    */

    'compiled' => $compiledPath,

];
