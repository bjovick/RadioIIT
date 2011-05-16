<?php defined('SYSPATH') or die('No direct script access.');

class Model_Recomendaciones extends Model {
	protected static $_tabla = 'recomendaciones';

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

		$select->order_by('pedida_en','desc');

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

	public static function editar($id, array $datos) {
	}

	public static function agregar($datos) {
		//valores basicos
		if (empty($datos['titulo']) || empty($datos['artista'])) {
			return false;
		}
		$u = Auth::usuario();
		$datos['usuario_idfk'] = $u['id'];
		$datos['pedida_en'] = "'".Fecha::a_bd(time())."'";

		$insert = DB::insert(self::$_tabla)
							->columns(array_keys($datos))
							->values(array_values($datos));

		return !!$insert->execute();
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
