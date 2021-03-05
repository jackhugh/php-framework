<?php

namespace Core;

class Response {

	public string $type;
	public array $headers = [];
	public $body;

	public function __construct(string $type = "html") {
		$this->type = $type;
		$this->headers['content-type'] = match ($type) {
			"html" => "text/html",
			"json" => "application/json"
		};

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