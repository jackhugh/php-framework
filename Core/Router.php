<?php

namespace Core;

use App\Controllers\ErrorController;
use Core\Exception\HTTPException;
use Throwable;

class Router {

	private static array $routers = [];
	
	private array $routes = [];

	use MiddlewareTrait;

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
				$controller->$controllerMethod();

				// Route is found, break out of the loop.
				return true;
			}
		}
		return false;
	}

	public static function dispatch(string $method, string $url) {
		$request = new Request($method, $url);
		$response = new Response();

		try {
			$matched = false;
			foreach(static::$routers as $router) {
				$matched = $router->dispatchRouter($request, $response);
				if ($matched) break;
			}
			if (!$matched) throw new HTTPException(404);

		} catch (Throwable $t) {
			$error = new ErrorController($request, $response);
			$error->handleException($t);		
		}
		$response->send();
	}
}
