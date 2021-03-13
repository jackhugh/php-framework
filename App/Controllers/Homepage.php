<?php

namespace App\Controllers;

use Core\Controller;
use Core\Exception\HTTPException;
use Core\View;

class Homepage extends Controller {
	
	public function route1() {
		return $this->response->headers;
	}

	public function route2() {
		return $this->response->headers;
	}
}