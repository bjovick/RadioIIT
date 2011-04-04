<?php defined('SISPATH') or die('No se permite accesso directo al archivo.');

/**
 * Esta es la clase nucleo. Matiene propiedades y metodos
 * generales en contexto del desarrollo de la pagina y el sistema en si
 */
class Nucleo {
	public static function auto_load($class) {
		//TODO extendible a que trabaje con namespaces
		//$file = str_replace('-','_',$class);
		$file = preg_match("/^Control_/", $class) ? CONTROLESPATH : SISPATH;
		$file .= $class.'.php';

		if(is_file($file)) {
			require $file;
			return class_exists($class, false);
		}
		return false;
	}
}
