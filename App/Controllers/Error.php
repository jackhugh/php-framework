<?php

namespace App\Controllers;

use Core\Controller;
use Core\Exception\HTTPException;
use Core\View;
use Throwable;

class Error extends Controller {

	private function page(int $code, string $msg) {
		$this->response->body = View::render("error.phtml", ['code' => $code, 'msg' => $msg]);
	}

	private function api(int $code, string $msg) {
		$this->response->body = [
			'success' => false,
			'code' => $code,
			'message' =>$msg
		];
	}
	
	public function handleException(Throwable $e) {
		if ($e::class !== HTTPException::class) {
			if ($_ENV['ENVIRONMENT'] === "dev") {
				// We are in a dev environment and this is not an HTTP exception, re-throw the exception.
				throw $e;
				
			} else {
				// This is a production environment and something has gone wrong.
				// Log the error as it has been caught.
				$class = $e::class;
				$msg = $e->getMessage();
				$trace = $e->getTraceAsString();
				error_log("$class: $msg in $trace");

				// Re-throw the exception as a HTTPException.
				$e = new HTTPException(500);
			}
		}

		$this->response->responseCode = $e->getCode();

		if ($this->response->type === "html") {
			$this->page($e->getCode(), $e->getMessage());
		} else {
			$this->api($e->getCode(), $e->getMessage());
		}
	}
}