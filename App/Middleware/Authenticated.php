<?php

namespace App\Middleware;

use Core\Middleware;
use Core\Request;
use Core\Response;

class Authenticated implements Middleware {
	public function run(Request $req, Response $resp):bool {
		// $resp->body = 123;
		// $resp->send();
		return true;
	}
}