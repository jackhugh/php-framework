<?php

namespace Core;

use ErrorException;
use stdClass;

class Route {
	
	use HasMiddleware;
	use RouteVerbs;

	public string $regex;
	public array $params = [];
	
	
	public function __construct(
		public string $verb,
		public string $route,
		public stdClass $controller,
		public string $type,
	) {
		$regex = $this->route;

		// Escape route for regex.
		$regex = preg_quote($regex, "/");

		// Find all route parameters.
		$regex = preg_replace_callback("/\\\{(.+?)\\\}/", function($matches) {
			
			// Store the param name for recalling later.
			$this->params[] = $matches[1];
			
			// Replace with regex for matching request route.
			return "(.+?)";

		}, $regex);

		// Enclose final regex ready for use.
		$this->regex = "/^$regex$/";
	}

	public function match(Request $request): bool {
		if (
			$this->verb === $request->method &&
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
