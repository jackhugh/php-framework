<?php

namespace Core;

use Core\Exception\HTTPException;
use Exception;

class Router {

	public static array $routers = [];

	public array $routes = [];

	public function __construct() {
		static::$routers[] = $this;
	}

	public function addRoute(Route $route) {
		$this->routes[] = $route;
	}
	public function addMiddleware(Middleware $middleware) {
	}

	public static function dispatch(string $method, string $url) {
		
		$request = new Request($method, $url);
		$response = null;

		try {
			foreach (static::$routers as $router) {
				foreach ($router->routes as $route) {
					
					if ($route->match($request)) {
						$response = new Response($route);

						$controllerClass = $route->controller;
						$controllerMethod = $route->controllerMethod;

						$controller = new $controllerClass($request, $response);
						$controller->$controllerMethod();
						$response->send();
						return;
					}
				}
			}
			// We haven't found the route, create 404.
			throw new HTTPException(404);
		
		} catch (Exception $e) {
			$response ??= new Response();
			$error = new ErrorController($request, $response);
			$error->handleException($e);
			$response->send();
		}
	}
}
