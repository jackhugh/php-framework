<?php

namespace Core;

use stdClass;

class Request {
	
	public string $method;
	public string $url;
	public stdClass $params;
	public stdClass $query;
	public stdClass $body;
	public stdClass $cookies;

	public function __construct(string $method, string $url) {
		$this->method = $method;
		$this->url = $url;
		$this->query = (object) $_GET;
		$this->post = (object) $_POST;
		$this->cookies = (object) $_COOKIE;
	}

}