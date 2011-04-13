<?php defined('SYSPATH') or die('No direct script access.');

class Model_Horarios extends Model {
	protected static $_tabla = 'horarios';

	/**
	 * funciones basicas BREAD de almacenamiento presistente
	 */
	public static function navegar($limite = null, array $filtros = array()) {
		$select = DB::select('*')->from(self::$_tabla);
		if(!is_null($limite)) {
			$select->limit($limite);
		}
		foreach($filtro as $filtro) {
			$select->where($filtro[0],$filtro[1],$filtro[2]);
		}

		$select->order_by('nombre','asc');

		return $select->execute();
	}

	public static function leer($id) {
	}


	public static function editar($id) {
	}

	public static function agregar($datos) {
	}

	public static function eliminar($id) {
		$filtro = is_int($idnombre)
						? array('id','=',$idnombre)
						: array('nombre','=',$idnombre);
		return (bool) DB::delete($this->_tabla)
									->where($filtro[0],$filtro[1],$filtro[2])
									->execute();
	}
}
