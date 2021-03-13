<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

class User extends Controller {
	
	public function show() {
		return View::render("user.phtml", ['user' => $this->request->params->user]);
	}

}