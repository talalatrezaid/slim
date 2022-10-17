<?php

// Should be set to 0 in production
error_reporting(E_ALL);

// Should be set to '0' in production
ini_set('display_errors', '1');

// Settings
$settings = [
    'displayErrorDetails' => true, // Should be set to false in production
    'logger' => [
        'name' => 'slim-app',
        'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
    ],
    "db" => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'username' => 'root',
        'database' => 'slim',
        'password' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        
    ],
];

// ...

return $settings;