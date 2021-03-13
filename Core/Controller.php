<?php

namespace Core;

use ErrorException;

abstract class Controller {
	
	public function __construct(
		protected Request $request,
		protected Response $response
	) {}
	
	public static function method(string $methodName) {
		if (method_exists(static::class, $methodName)) {
			return (object) [
				'class' => static::class,
				'method' => $methodName
			];
		} else {
			throw new ErrorException("Controller method does not exist.");
		}
	}
}