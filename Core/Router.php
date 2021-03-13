<?php

namespace Core;

use Core\Exception\HTTPException;
use App\Controllers\Error;
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
		// Iterate all routes in this router.
		foreach ($this->routes as $route) {
			if ($route->match($req)) {
				// We have matched a route.

				$resp->setType($route->type);

				// Run all router middleware.
				$this->runMiddleware($req, $resp);
				// Run all controller specific middleware.
				$route->runMiddleware($req, $resp);

				// Create controller instance and run route method.
				$controllerClass = $route->controller->class;
				$controllerMethod = $route->controller->method;
				
				$controller = new $controllerClass($req, $resp);
				$resp->body = $controller->$controllerMethod();

				// Route is found, break out of the loop.
				return true;
			}
		}
		return false;
	}

	public static function dispatch(string $method, string $url) {
		
		// Create request and response objects.
		$req = new Request($method, $url);
		$resp = new Response();

		// Run any globally registered middleware.
		static::runStaticMiddleware($req, $resp);

		// Iterate through all routers to find matching route.
		try {
			$matched = false;
			foreach(static::$routers as $router) {
				$matched = $router->dispatchRouter($req, $resp);
				if ($matched) break;
			}
			// We have iterated through all routers and routes but no match, throw 404 exception.
			if (!$matched) throw new HTTPException(404);

		} catch (Throwable $t) {
			// Let error controller handle exception according to environment.
			$error = new Error($req, $resp);
			$error->handleException($t);		
		}

		// Response has been mutated by all middleware/routes/exception handlers and we can now send.
		$resp->send();
	}
}
