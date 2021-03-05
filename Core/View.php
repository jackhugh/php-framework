<?php

namespace Core;

class View {
	public static function render(string $file, array $params = []) {
		extract($params);
		ob_start();
		include __DIR__ . "/../App/views/" . $file;
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}