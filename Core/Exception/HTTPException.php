<?php

namespace Core\Exception;

use Exception;

class HTTPException extends Exception {

	public function __construct(int $code, string $msg = "") {
		if (empty($msg)) {
			$messages = include __DIR__ . "/../../App/config/HTTPResponses.php";

			$msg = $messages[$code] ?? "";
		}
		
		parent::__construct($msg, $code);
	}
}

