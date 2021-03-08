<?php

namespace Core;

trait MiddlewareTrait {
	
	protected array $middleware = [];

	public function addMiddleware(Middleware $middleware) {
		$this->middleware[] = $middleware;
	}
	
	public function runMiddleware(Request $request, Response $response) {
		foreach ($this->middleware as $middleware) {
			$middleware->run($request, $response);
		}
	}
}