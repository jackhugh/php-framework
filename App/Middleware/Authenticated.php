<?php

namespace App\Middleware;

use Core\Exception\HTTPException;
use Core\Middleware;
use Core\Request;
use Core\Response;

class Authenticated implements Middleware {
	public static function run(Request $req, Response $resp) {
		if (false) {
			throw new HTTPException(401);
		}
	}
}