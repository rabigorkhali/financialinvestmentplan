<?php

return [
    'URL' => env('APP_URL'),
    'APP_DOMAIN' => env('APP_DOMAIN'),
    'APP_PROTOCOL' => env('APP_PROTOCOL', 'https'),
    'PREFIX' => env('PREFIX', 'system'),
    'TWOFA' => env('TWOFA', 1),
    'META' => ['meta' => [
        'copyright' => 'Copyright 2023 E.K. Solutions Pvt. Ltd.',
        'site' => env('APP_URL'),
        'emails' => ['nirjar.maharjan@ekbana.info', 'ekbana@info.com'],
        'api' => [
            'version' => 1,
        ],
    ]],
    'FROM_MAIL' => env('MAIL_FROM_ADDRESS', 'info@ekbana.com'),
    'FROM_NAME' => env('MAIL_FROM_NAME', 'Ekbana'),
    'DEFAULT_LOCALE' => env('DEFAULT_LOCALE', 'en'),
    'ADMIN_DEFAULT_EMAIL' => env('ADMIN_DEFAULT_EMAIL', 'info@ekbana.com'),
    'DEFAULT_LINK_EXPIRATION' => env('DEFAULT_LINK_EXPIRATION' ?? 30),

    'DEFAULT_TWO_FA_REQUEST_EXPIRATION' => env('DEFAULT_TWO_FA_REQUEST_EXPIRATION' ?? 10),
    'DEFAULT_TWO_FA_THROTTLE_LIMIT' => env('DEFAULT_TWO_FA_THROTTLE_LIMIT', 4),
    'DEFAULT_TWO_FA_THROTTLE_EXPIRATION' => env('DEFAULT_TWO_FA_THROTTLE_EXPIRATION', 2),

    'DEFAULT_LOGIN_ATTEMPT_LIMIT' => env('DEFAULT_LOGIN_ATTEMPT_LIMIT', 4),
    'DEFAULT_LOGIN_ATTEMPT_EXPIRATION' => env('DEFAULT_LOGIN_ATTEMPT_EXPIRATION', 2),

    'DEFAULT_FORGOT_PASSWORD_LIMIT' => env('DEFAULT_FORGOT_PASSWORD_LIMIT', 4),
    'DEFAULT_FORGOT_PASSWORD_EXPIRATION' => env('DEFAULT_FORGOT_PASSWORD_EXPIRATION', 2),

    'API_URL' => env('API_URL', 'http://ip-api.com'),
    'IP_ADDRESS' => env('IP_ADDRESS', '110.44.123.47'),
];
