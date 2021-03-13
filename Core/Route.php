<?php

namespace Core;

use BadMethodCallException;

class Route {
	
	public string $regex;
	public array $params = [];
	
	use HasMiddleware;

	public function __construct(
		public string $httpMethod,
		public string $route,
		public string $controller,
		public string $controllerMethod,
		public string $type = "html",
	) {
		$regex = $this->route;
		$regex = preg_quote($regex, "/");
		$regex = preg_replace_callback("/\\\{(.+?)\\\}/", function($matches) {
			$param = $matches[1];
			$this->params[] = $param;
			return "(.+?)";
		}, $regex);
		$this->regex = "/^$regex$/";
	}

	public static function __callStatic($name, $arguments) {
		$validVerbs = [
			'GET',
			'POST',
			'DELETE',
			'PUT',
			'PATCH'
		];
		if (in_array($name, $validVerbs)) {
			return new static($name, ...$arguments);
		} else {
			throw new BadMethodCallException("Invalid HTTP Verb");
		}
	}

	public function match(Request $request) {
		if (
			$this->httpMethod === $request->method &&
			preg_match_all($this->regex, $request->url, $matches, PREG_SET_ORDER)
		) {
			$this->setParams($matches, $request);
			return true;
		} else {
			return false;
		}
	}

	public function setParams(array $matches, Request $request) {
		$matches = $matches[0];
		array_shift($matches);
		$params = [];
		foreach ($this->params as $key => $param) {
			$params[$param] = $matches[$key];
		}
		$request->params = (object) $params;
	}

}
