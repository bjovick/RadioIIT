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
		foreach($filtros as $filtro) {
			$select->where($filtro[0],$filtro[1],$filtro[2]);
		}

		$select->order_by('nombre','asc')->order_by('dia','asc');

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

	public static function leer($idonombre, $campos = '*') {
		if (is_string($idonombre)) { //es nombre
			return self::seleccionar(array(array('nombre','=',$idonombre)), $campos);
		} elseif (is_int($idonombre)) { //es id
			return self::seleccionar(array(array('id','=',$idonombre)), $campos);
		}

		return false;
	}

	public static function editar($id, array $cambios) {
		$h = self::leer($id)->current();
		$delta = array_diff($cambios, $h);
		if (empty($delta)) {
			return true;
		}

		$res = DB::update(self::$_tabla)
						->set($delta)
						->where('id','=',$id);
		
		return !!$res->execute();
	}

	public static function agregar($datos) {
		//valores basicos
		if (empty($datos['generos']) || empty($datos['dia'])) {
			return false;
		}

		$insert = DB::insert(self::$_tabla)
							->columns(array_keys($datos))
							->values(array_values($datos));

		return !!$insert->execute();
	}

	public static function eliminar($id) {
		return (bool) DB::delete(self::$_tabla)
									->where('id','=',(int) $id)
									->execute();
	}
}
