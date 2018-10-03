<?php
/**
 * Application middleware
 *
 * PHP version 5.6
 *
 * @package  CDR-API
 * @author   mrpbueno
 * @license  http://www.gnu.org/licenses/gpl-3.0.txt GPLv3+
 * @link     https://github.com/goiabinha/cdr-api
 */

// e.g: $app->add(new \Slim\Csrf\Guard);

use Slim\Middleware\TokenAuthentication;

$app->add(new \Slim\Middleware\TokenAuthentication([
    'header' => 'Authorization',
    'regex' => '/(.*)/',
    'path' => '/api',
    'authenticator' => function ($request, TokenAuthentication $tokenAuth) {
        $token = $tokenAuth->findToken($request);
        if ($token == getenv('APP_TOKEN')) {
            return true;
        } else {
            return false;
        }
    }
]));

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Authorization, Origin, Accept')
        ->withHeader('Access-Control-Allow-Methods', 'GET, OPTIONS');
});
