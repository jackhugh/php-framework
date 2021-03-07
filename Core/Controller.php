<?php

namespace Core;

class Controller {
	
	public function __construct(
		public Request $request,
		public Response $response
	) {}
	
}