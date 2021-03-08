<?php

namespace App\Mappers;

use Core\Mapper;
use PDO;

class User extends Mapper {
	public function read() {
		$data = $this->DB->query("SELECT * FROM MyGuests");
		print_r($data->fetchAll(PDO::FETCH_OBJ));
	}
}