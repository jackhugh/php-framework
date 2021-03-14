<?php
namespace App;

use App\Controllers\Homepage;
use App\Controllers\User;
use App\Middleware\Authenticated;
use App\Middleware\CustomHeader;
use Core\Request;
use Core\Route;
use Core\Router;

$routes = new Router();
$routes->addRoute(Route::GET('/', Homepage::method('show')));

$authRoutes = new Router();
$authRoutes->addMiddleware(new Authenticated());
$authRoutes->addRoute(Route::GET('/user/{user}', User::method('show')));

Router::addStaticMiddleware(new CustomHeader('X-Custom-Header', 'abc123'));

Router::dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));