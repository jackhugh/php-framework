<?php

namespace Core;

class Response {

	public string $type;
	public array $headers = [];
	public $body;

	public function __construct() {
		$this->setType("html");
	}

	public function setType(string $type) {
		$this->headers['content-type'] = match ($type) {
			'html' => 'text/html',
			'json' => 'application/json',
		};
		$this->type = $type;
	}

	public function responseCode($code) {
		http_response_code($code);
	}

	public function redirect(string $location) {
		header("location: $location");
		die;
	}

	public function send() {
		foreach ($this->headers as $header => $value) {
			header("$header: $value");
		}
		if ($this->type === "json") {
			$this->body = json_encode($this->body);
		}
		echo $this->body;
		die;
	}
}