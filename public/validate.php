<?php

class Validate {

	public static function this($value) {
		return new self($value);
	}

	private $value;
	private $status = true;

	public function __construct($value) {
		$this->value = $value;
	}
	
	private function combineStatus($newValue) {
		$this->status = $this->status && $newValue;
	}

	public function getBool() {
		return $this->status;
	}

	public function getSelf() {
		
	}

	public function is($type) {
		$this->combineStatus(Type::testType($this->value, $type));
		return $this;
	}

}

class Type {
	const INT = "is_int";
	const FLOAT = "is_float";
	const NUMBER = "is_numeric";

	const STRING = "is_string";

	const ARRAY = "is_array";
	const OBJECT = "is_object";

	public static function testType($value, $type) {
		return call_user_func($type, $value);
	}
}
var_dump(Validate::this(123)->is(Type::INT)->is(Type::NUMBER)->getBool());