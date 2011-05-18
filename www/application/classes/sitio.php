<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Configuraciones globales del sitio
 */
class Sitio {
	protected static $_tabla = 'configuracion_sitio';

	public static function recaptcha_llave_publica() {
		return '6LdlccMSAAAAAC9Ub6CnifzcX1Gng8wt4hTid4Ok';
	}

	public static function recaptcha_llave_privada() {
		return '6LdlccMSAAAAAKvPCnmTrirZBcVOqn6F_yrmC6gJ';
	}

	/**
	 * regresa las configuraciones del sitio guardadas en la
	 * base de datos
	 */
	public static function configs() {
		return DB::select('*')
			->from(self::$_tabla)
			->execute()
			->as_array();
	}

	public static function config($llave, $valor = null) {
		if (is_null($valor)) { //quiere saber el valor
			return DB::select('valor')
							->from(self::$_tabla)
							->where('llave', '=', $llave)
							->execute()
							->get('valor');
		} else { //quiere guardar el valor en esa llave
			$llave_existe = DB::select('llave')->from(self::$_tabla)
				->where('llave','=',$llave)->execute()->as_array();
			$llave_existe = (count($llave_existe) > 0);
			if ($llave_existe) { //actualizar en vez de agregar
				return !!DB::update(self::$_tabla)
								->set(array('llave'=>$llave,'valor'=>$valor))
								->where('llave','=',$llave)
								->execute();
			} else { //a agregar nuevo valor
				return !!DB::insert(self::$_tabla)
								->columns(array('llave','valor'))
								->values(array($llave,$valor))
								->execute();
			}
		}
	}
}
