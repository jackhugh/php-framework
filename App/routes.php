<?php
namespace App;

use Core\Router;
use Core\Route;
use App\Controllers\Homepage;
use App\Middleware\TestHeader;

$router = new Router();

$router->addRoute(new Route("GET", "/profile/{user}", Homepage::class, "user"));
$router->addMiddleware(new TestHeader());

Router::dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
