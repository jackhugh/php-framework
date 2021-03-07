<?php
require_once __DIR__ . "/../vendor/autoload.php";

use App\Controllers\Homepage;
use App\Middleware\TestHeader;
use Core\Router;
use Core\Route;


$routes = new Router();
$headRoutes = new Router();

$routes->addRoute(new Route("GET", "/profile/{user}", Homepage::class, "user"));
$routes->addMiddleware(new TestHeader());

$headRoutes->addRoute(new Route("GET", "/", Homepage::class, "root"));

$routes->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
