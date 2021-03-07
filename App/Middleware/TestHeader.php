<?php

namespace App\Middleware;

use Core\Middleware;
use Core\Request;
use Core\Response;

class TestHeader implements Middleware
{
	public function run(Request $req, Response $resp) {
		$resp->headers['test-header'] = 'hello';
	}
}
