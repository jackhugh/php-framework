<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

class Homepage extends Controller {
	public function show() {
		return View::render('homepage.phtml');
	}
}