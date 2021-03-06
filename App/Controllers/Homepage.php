<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;
use Exception;

class Homepage extends Controller{

	public function user() {
		$this->response->body = View::render("user.phtml", ['user' => $this->request->params->user]);
	}
	public function test() {
		throw new Exception();
	}

}