<?php
/**
 * DIC configuration
 *
 * PHP version 5.6
 *
 * @package  CDR-API
 * @author   mrpbueno
 * @license  http://www.gnu.org/licenses/gpl-3.0.txt GPLv3+
 * @link     https://github.com/goiabinha/cdr-api
 */

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// db
$container['db'] = function ($c) {
    $manager = new \Illuminate\Database\Capsule\Manager;
    $manager->addConnection($c->get('settings')['db']);
    $manager->setAsGlobal();
    $manager->bootEloquent();
    return $manager->getConnection('default');
};

// Override the default Not Found Handler
$container['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return $c['response']
            ->withJson(['message' => 'Not found'], 404);
    };
};

// Override the default Not Allowed handler
$container['notAllowedHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return $c['response']
            ->withJson(['message' => 'Method not allowed'], 405);
    };
};
