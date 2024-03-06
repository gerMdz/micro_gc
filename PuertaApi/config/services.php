<?php

namespace config;

return [
    'autores' => [
        'base_uri' => env('AUTORES_SERVICE_BASE_URL'),
        'secret' => env('AUTORES_SERVICE_SECRET')
    ],
    'libros' => [
        'base_uri' => env('LIBROS_SERVICE_BASE_URL'),
        'secret' => env('LIBROS_SERVICE_SECRET')
    ]
];
