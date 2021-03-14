<?php

namespace Core;

use ReflectionMethod;

// For autocomplete. 
trait RouteVerbs {
	public static function GET(string $route, ReflectionMethod $controller, string $type = "HTML") {
		return new Route(__FUNCTION__, ...func_get_args());
	}
	public static function POST(string $route, ReflectionMethod $controller, string $type = "HTML") {
		return new Route(__FUNCTION__, ...func_get_args());
	}
	public static function PUT(string $route, ReflectionMethod $controller, string $type = "HTML") {
		return new Route(__FUNCTION__, ...func_get_args());
	}
	public static function PATCH(string $route, ReflectionMethod $controller, string $type = "HTML") {
		return new Route(__FUNCTION__, ...func_get_args());
	}
	public static function DELETE(string $route, ReflectionMethod $controller, string $type = "HTML") {
		return new Route(__FUNCTION__, ...func_get_args());
	}
}