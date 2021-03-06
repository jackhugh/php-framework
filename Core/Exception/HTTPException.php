<?php

namespace Core\Exception;

use Exception;

class HTTPException extends Exception {
	public function __construct(int $code, string $msg = "") {
		parent::__construct($msg, $code);
	}
}

