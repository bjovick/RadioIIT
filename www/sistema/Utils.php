<?php

class Utils {
	public static function nomen($str, $tipo = 'variable') {
		$str = preg_replace('/[-_]+/', ' ', strtolower(trim($str)));

		switch($tipo) {
			case 'clase':
				$str = ucwords($str);
				break;
			case 'variable':
			case 'metodo':
			case 'funcion':
				break;
			case 'privado':
				$str = '_'.$str;
				break;
			case 'const':
				$str = strtoupper($str);
				break;
		}

		return str_replace(' ', '_', $str);
	}
