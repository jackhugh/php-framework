<?php
header("Content-Type: text/plain");
require_once __DIR__ . "/../vendor/autoload.php";

use App\Middleware\Authenticated;
use App\Controllers\Homepage;
use Core\Router;
use Core\Route;

Router::register(new Route("GET", "/", Homepage::class, "index"));
Router::register(new Route("GET", "/users/{user}", Homepage::class, "user"));
Router::register(new Route("GET", "/test", Homepage::class, "test", "json"));

Router::middleware(new Authenticated());

Router::dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));