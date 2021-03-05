<?php

namespace App\Controllers;

use Core\View;

class Homepage {
	public function index($req, $resp) {
		$resp->body = "root";
	}
	public function user($req, $resp) {
		$resp->body = View::render("user.phtml", ['user' => $req->params->user]);
	}

}