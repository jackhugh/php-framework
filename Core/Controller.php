<?php

namespace Core;

class Controller {
	
	public function __construct(
		protected Request $request,
		protected Response $response
	) {}
	
}