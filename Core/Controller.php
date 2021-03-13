<?php

namespace Core;

use BadMethodCallException;
use InvalidArgumentException;

class Controller {
	
	public function __construct(
		protected Request $request,
		protected Response $response
	) {}
	
	public static function __callStatic($name, $args) {

		if ($name !== "method") return;

		$args[0] ?? throw new InvalidArgumentException("No method name passed.");

		if (method_exists(static::class, $args[0])) {
			return (object) [
				'class' => static::class,
				'method' => $args[0]
			];
		} else {
			throw new BadMethodCallException("Controller method does not exist.");
		}
	}
}