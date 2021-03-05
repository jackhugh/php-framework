<?php

namespace Core;

class Controller {
	

	public function __construct(
		protected Route $route
	) {
		
	}
}