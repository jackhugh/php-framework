<?php

namespace Core;

interface Middleware {
	public static function run(Request $req, Response $resp);
}