<?php

namespace Core;

use Core\Exception\HTTPException;
use Throwable;

class Router {

	public static array $routers = [];

	public array $routes = [];
	public array $middleware = [];

	public function __construct() {
		static::$routers[] = $this;
	}

	public function addRoute(Route $route) {
		$this->routes[] = $route;
	}
	
	public function addMiddleware(Middleware $middleware) {
		$this->middleware[] = $middleware;
	}

	public static function dispatch(string $method, string $url) {
		
		$request = new Request($method, $url);
		$response = new Response();

		try {
			foreach (static::$routers as $router) {
				
				foreach ($router->routes as $route) {

					// We have matched a route.
					if ($route->match($request)) {

						$response->setType($route->type);

						// Run all middlewares for this router.
						foreach ($router->middleware as $middleware) {
							$middleware->run($request, $response);
						}

						// Create controller instance and run route method.
						$controllerClass = $route->controller;
						$controllerMethod = $route->controllerMethod;
						
						$controller = new $controllerClass($request, $response);
						$controller->$controllerMethod();

						// Route is found, break out of the loop.
						return;
					}
				}
			}
			// We haven't found the route, create 404.
			throw new HTTPException(404);
			
		} catch (Throwable $t) {
			$error = new ErrorController($request, $response);
			$error->handleException($t);
			
		} finally {
			// FIXME this will stop dev errors from showing.
			$response->send();
		}
	}
}
