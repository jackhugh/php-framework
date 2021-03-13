<?php

namespace Core;

class View {
	
	public static function render(string $file, array $params = [], bool $sanetize = true) {
		extract($params);
		ob_start();
		include __DIR__ . "/../App/views/" . $file;
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	public static function sanetize(&$data) {
		if (!is_array($data)) $data = [$data];

		array_walk_recursive($data, function (&$value) {
			$value = htmlentities($value);
		});

		return $data;
	}
}
