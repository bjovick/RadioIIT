<?php defined('SYSPATH') or die('No direct script access.');

class Model_Canciones extends Model {
	protected static $_tabla = 'canciones';

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

		$select->order_by('titulo','asc');

		return $select->execute();
	}

	/**
	 * Version similar de navegar pero un poco de control sobre los campos
	 */
	public static function seleccionar($filtros, $campos='*') {
		$select = DB::select($campos)->from(self::$_tabla);
		foreach ($filtros as $filtro) {
			$select->where($filtro[0],$filtro[1],$filtro[2]);
		}

		return $select->execute();
	}

	public static function leer($idotitulo, $campos = '*') {
		if (is_string($idotitulo)) { //es titulo 
			return self::seleccionar(array(array('titulo','=',$idotitulo)), $campos);
		} elseif (is_int($idotitulo)) { //es id
			return self::seleccionar(array(array('id','=',$idotitulo)), $campos);
		}

		return false;
	}


	public static function editar($idoruta) {
	}

	public static function agregar($datos) {
		//asegurarse que los datos basicos existen
		//asegurarse que no exista la cancion en la bd
	}

	public static function eliminar($idoruta) {
		$filtro = is_int($idoruta)
						? array('id','=',$idoruta)
						: array('ruta','=',$idoruta);
		return (bool) DB::delete($this->_tabla)
									->where($filtro[0],$filtro[1],$filtro[2])
									->execute();
	}
}
