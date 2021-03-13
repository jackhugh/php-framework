<?php

namespace Core;

use Core\Exception\HTTPException;
use \App\Controllers\Error;
use Throwable;

class Router {

	use HasMiddleware;
	use HasStaticMiddleware;
	
	private static array $routers = [];
	
	private array $routes = [];


	public function __construct() {
		static::$routers[] = $this;
	}

	public function addRoute(Route $route) {
		$this->routes[] = $route;
	}

	private function dispatchRouter(Request $req, Response $resp) {
		foreach ($this->routes as $route) {
			// We have matched a route.
			if ($route->match($req)) {

				$resp->setType($route->type);

				// Run all router middleware.
				$this->runMiddleware($req, $resp);
				// Run all controller specific middleware.
				$route->runMiddleware($req, $resp);

				// Create controller instance and run route method.
				$controllerClass = $route->controller;
				$controllerMethod = $route->controllerMethod;
				
				$controller = new $controllerClass($req, $resp);
				$resp->body = $controller->$controllerMethod();

				// Route is found, break out of the loop.
				return true;
			}
		}
		return false;
	}

	public static function dispatch(string $method, string $url) {
		$req = new Request($method, $url);
		$resp = new Response();

		static::runStaticMiddleware($req, $resp);

		try {
			$matched = false;
			foreach(static::$routers as $router) {
				$matched = $router->dispatchRouter($req, $resp);
				if ($matched) break;
			}
			if (!$matched) throw new HTTPException(404);

		} catch (Throwable $t) {
			$error = new Error($req, $resp);
			$error->handleException($t);		
		}
		$resp->send();
	}
}
