<?php

return [
    'database' => [
        'name' => 'pardis_api',
        'username' => 'api_user',
        'password' => 'api_password',
        'connection' => 'mysql:host=127.0.0.1',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]
];
