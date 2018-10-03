<?php

$dotenv = new Dotenv\Dotenv(__DIR__ .'/../');
$dotenv->load();

return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false,

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Database settings
        'db' => [
            'driver' => getenv('DB_CONNECTION'),
            'host' => getenv('DB_HOST'),
            'database' => getenv('DB_DATABASE'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
        ],
    ],
];
