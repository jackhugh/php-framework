<?php
require_once __DIR__ . "/../vendor/autoload.php";

use Dotenv\Dotenv;
use App\Controllers\Homepage;
use Core\Router;
use Core\Route;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$router = new Router();

$router->addRoute(new Route("GET", "/profile/{user}", Homepage::class, "user"));

$router->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
