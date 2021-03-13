<?php

namespace App\Middleware;

use Core\Middleware;
use Core\Request;
use Core\Response;

class CustomHeader implements Middleware {

	public function __construct(string $header, string $value) {
		$this->header = $header;
		$this->value = $value;
	}

	public function run(Request $req, Response $resp) {
		$resp->headers[$this->header] = $this->value;
	}
}
