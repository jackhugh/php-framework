<?php

namespace Core;

use ErrorException;
use stdClass;

class Route {
	
	public string $regex;
	public array $params = [];
	
	use HasMiddleware;
	use RouteVerbs;
	
	public function __construct(
		public string $verb,
		public string $route,
		public stdClass $controller,
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
