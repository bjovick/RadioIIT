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

	public static function seleccionar($filtros, $campos = '*') {
	}

	public static function leer($idoruta) {
	}


	public static function editar($ido_ruta) {
	}

	public static function agregar($datos) {
		//asegurarse que los datos basicos existen
		//asegurarse que no exista la cancion en la bd
	}

	public static function eliminar($idoruta) {
		$filtro = is_int($idnombre)
						? array('id','=',$idnombre)
						: array('nombre','=',$idnombre);
		return (bool) DB::delete($this->_tabla)
									->where($filtro[0],$filtro[1],$filtro[2])
									->execute();
	}
}
