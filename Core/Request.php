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

	public function __construct(string $method, string $url, array $params) {
		$this->method = $method;
		$this->url = $url;
		$this->params = (object) $params;
		$this->query = (object) $_GET;
		$this->post = (object) $_POST;
		$this->cookies = (object) $_COOKIE;
	}

}