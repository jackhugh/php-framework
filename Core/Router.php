<?php

namespace Core;

use Core\Exception\HTTPException;

class Router {
	public static array $routes = [];
	public static array $middleware = [];

	public static function register(Route $route) {
		static::$routes[] = $route;
	}

	public static function middleware(Middleware $middleware) {
		static::$middleware[] = $middleware;
	}

	public static function dispatch(string $method, string $url) {

		// create req and response. 


		// try {
			foreach (static::$routes as $route) {
				if ($method === $route->httpMethod) {
					if (preg_match_all($route->regex, $url, $matches, PREG_SET_ORDER)) {
						$matches = $matches[0];
						array_shift($matches);
						$params = [];
						foreach ($route->params as $key => $param) {
							$params[$param] = $matches[$key];
						}
						$request = new Request($method, $url, $params);
						$response = new Response($route->responseType);
						foreach (static::$middleware as $middleware) {
							$middleware->run($request, $response);
						}
						// print_r($route);
						// print_r($request);
						// print_r($response);
	
						$controller = new ($route->controller)();
						$controller->{$route->controllerMethod}($request, $response);
						$response->send();
						return;
					}
				}
			}
			throw new HTTPException(404);

		// } catch (\Throwable $e) {
			// $e::class === HTTPException::class ? throw $e : throw new HTTPException(500);
		// }


	}
}