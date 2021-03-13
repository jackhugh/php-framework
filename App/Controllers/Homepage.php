<?php

namespace App\Controllers;

use Core\Controller;
use Core\Exception\HTTPException;
use Core\View;
use Exception;

class Homepage extends Controller {
	
	public function homepage() {
		return json_encode($this->request);
	}
	public function user() {
		return View::render("user.phtml", ['user' => $this->request->params->user]);
	}
	public function test() {
		return $this->request;
	}
}