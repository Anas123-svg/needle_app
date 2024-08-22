<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
            'hash' => false,
        ],

        'artist' => [
            'driver' => 'sanctum',
            'provider' => 'artists',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'artists' => [
            'driver' => 'eloquent',
            'model' => App\Models\Artist::class,
        ],
    ],

    'passwords' => [
        'artists' => [
            'provider' => 'artists',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    
        'users' => [
            'provider' => 'users',
            'reset' => 'passwords',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
