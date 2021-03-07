<?php

namespace Core;

use App\Config;
use Core\Exception\HTTPException;
use Throwable;

class ErrorController extends Controller {

	public function page(int $code, string $msg) {
		$this->response->body = View::render("error.phtml", ['code' => $code, 'msg' => $msg]);
	}

	public function api(int $code, string $msg) {
		$this->response->body = [
			'success' => false,
			'code' => $code,
			'message' =>$msg
		];
	}

	public function handleException(Throwable $e) {
		if ($e::class !== HTTPException::class) {
			if (Config::ENV === "dev") {
				// We are in a dev environment and this is not an HTTP exception, re-throw the exception.
				throw $e;

			} else {
				// This is a production environment and something has gone wrong, recreate the exception as HTTPException (500).
				$e = new HTTPException(500);
			}
		}

		$this->response->responseCode($e->getCode());

		if ($this->response->type === "html") {
			$this->page($e->getCode(), $e->getMessage());
		} else {
			$this->api($e->getCode(), $e->getMessage());
		}
	}
}