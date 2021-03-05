<?php

namespace Core;

class Route {

	public string $regex;
	public array $params = [];

	public function __construct(
		public string $httpMethod,
		public string $route,
		public string $controller,
		public string $controllerMethod,
		public string $responseType = "html"

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
}
