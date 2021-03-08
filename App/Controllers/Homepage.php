<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

class Homepage extends Controller{

	public function user() {
		return View::render("user.phtml", ['user' => $this->request->params->user]);
	}
	public function test() {
		return $this->request;
	}
}