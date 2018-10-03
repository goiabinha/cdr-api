<?php

$value = password_hash(openssl_random_pseudo_bytes(32),PASSWORD_DEFAULT);
$path = __DIR__ . '/.env';
$token = 'APP_TOKEN';

require __DIR__ . '/vendor/autoload.php';
$dotenv = new Dotenv\Dotenv(__DIR__ .'/');
$dotenv->load();

if (file_exists($path)) {
    file_put_contents($path, str_replace(
        $token . '=' . getenv('APP_TOKEN'), $token . '=' . $value, file_get_contents($path)
    ));

    echo "{$token}={$value}";
    echo PHP_EOL;
} else {
    echo "No .env file found";
    echo PHP_EOL;
}
