<?php
namespace App;

use Core\Router;
use Core\Route;
use App\Controllers\Homepage;
use App\Middleware\CustomHeader;

$router1 = new Router();
$router1->addMiddleware(new CustomHeader('X-Router-1', 'router 1'));
$router1->addRoute(Route::GET('/route1', Homepage::method('route1'), 'json'));

$router2 = new Router();
$router2->addMiddleware(new CustomHeader('X-Router-2', 'router 2'));
$router2->addRoute(Route::GET('/route2', Homepage::method('route2'), 'json'));

Router::addStaticMiddleware(new CustomHeader('X-Global', 'global'));

Router::dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
