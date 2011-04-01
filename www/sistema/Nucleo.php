<?php defined('SISPATH') or die('No direct script access.');

/**
 * Esta es la clase nucleo. Matiene propiedades y metodos
 * generales en contexto del desarrollo de la pagina y el sistema en si
 */
class Nucleo {
	public static function auto_load($class) {
		//TODO extendible a que trabaje con namespaces
		$file = SISPATH.$class.'.php';
		if(is_file($file)) {
			require $file;
			return class_exists($class, false);
		}
		return false;
	}
}
