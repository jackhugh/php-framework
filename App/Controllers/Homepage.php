<?php

namespace App\Controllers;

class Homepage {
	public function index($req, $resp) {
		$resp->body = 123;
	}
	public function user($req, $resp) {
		print_r($req);
		print_r($resp);
	}
	public function test($req, $resp) {
		$resp->body = [1,2,3,4];
	}
}