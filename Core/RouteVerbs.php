<?php

namespace Core;

use stdClass;

// For autocomplete. 
trait RouteVerbs {
	public static function GET(string $route, stdClass $controller, string $type = "HTML") {
		return new Route(__FUNCTION__, $route, $controller, $type);
	}
	public static function POST(string $route, stdClass $controller, string $type = "HTML") {
		return new Route(__FUNCTION__, $route, $controller, $type);
	}
	public static function PUT(string $route, stdClass $controller, string $type = "HTML") {
		return new Route(__FUNCTION__, $route, $controller, $type);
	}
	public static function PATCH(string $route, stdClass $controller, string $type = "HTML") {
		return new Route(__FUNCTION__, $route, $controller, $type);
	}
	public static function DELETE(string $route, stdClass $controller, string $type = "HTML") {
		return new Route(__FUNCTION__, $route, $controller, $type);
	}
}