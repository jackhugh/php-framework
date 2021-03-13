<?php
namespace App;

use Core\Router;
use Core\Route;
use App\Controllers\Homepage;

$routes = new Router();
$routes->addRoute(Route::GET("/", Homepage::method('index')));
$routes->addRoute(Route::GET("/article/{id}", Homepage::method('article')));

Router::dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
