<?php

namespace Core;

use stdClass;

// For autocomplete. 
trait RouteVerbs {
	public static function GET(string $route, stdClass $controller, string $type = "html") {
		return new Route(__FUNCTION__, ...func_get_args());
	}
	public static function POST(string $route, stdClass $controller, string $type = "html") {
		return new Route(__FUNCTION__, ...func_get_args());
	}
	public static function PUT(string $route, stdClass $controller, string $type = "html") {
		return new Route(__FUNCTION__, ...func_get_args());
	}
	public static function PATCH(string $route, stdClass $controller, string $type = "html") {
		return new Route(__FUNCTION__, ...func_get_args());
	}
	public static function DELETE(string $route, stdClass $controller, string $type = "html") {
		return new Route(__FUNCTION__, ...func_get_args());
	}
}