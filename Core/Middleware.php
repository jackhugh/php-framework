<?php

namespace Core;

interface Middleware {
	// TODO - implement before and after methods.
	public function run(Request $req, Response $resp);
}