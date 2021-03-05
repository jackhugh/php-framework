<?php

namespace Core;

class Request {
	
	public string $method;
	public string $url;
	public array $params;
	public array $query;
	public array $body;
	public array $cookies;

	public function __construct(string $method, string $url, array $params) {
		$this->method = $method;
		$this->url = $url;
		$this->params = $params;
		$this->query = $_GET;
		$this->post = $_POST;
		$this->cookies = $_COOKIE;
	}

}