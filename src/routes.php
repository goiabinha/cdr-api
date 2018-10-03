<?php

use Slim\Http\Request;
use Slim\Http\Response;

$container['db'];

// Routes

$app->options(
    '/api/{routes:.+}',
    function (Request $request, Response $response, array $args) {
        return $response;
    }
);

$app->get('/api/v1/cdr/calldate/{calldate}/{limit:[0-9]+}', '\App\Controllers\CdrController:calldate');
$app->get('/api/v1/cdr/uniqueid/{uniqueid}/{limit:[0-9]+}', '\App\Controllers\CdrController:uniqueid');
