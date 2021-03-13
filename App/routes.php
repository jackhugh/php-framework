<?php
namespace App;

use App\Controllers\User;
use Core\Route;
use Core\Router;

$routes = new Router();

$routes->addRoute(Route::GET('/profile/{user}', User::method('show')));

Router::dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
