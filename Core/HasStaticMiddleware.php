<?php

namespace Core;

trait HasStaticMiddleware {
	
	protected static array $staticMiddleware = [];

	public static function addStaticMiddleware(Middleware $middleware) {
		static::$staticMiddleware[] = $middleware;
	}
	
	public static function runStaticMiddleware(Request $request, Response $response) {
		foreach (static::$staticMiddleware as $middleware) {
			$middleware->run($request, $response);
		}
	}
}