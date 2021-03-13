<?php

namespace App\Middleware;

use Core\Exception\HTTPException;
use Core\Middleware;
use Core\Request;
use Core\Response;

class Authenticated implements Middleware {
	public function run(Request $req, Response $resp) {
		if ($req->params->user !== "jack") throw new HTTPException(401);
	}
}