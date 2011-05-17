<?php defined('SYSPATH') or die('No direct script access');

class Model_Contenidos extends Model {
	protected static $_tabla = 'contenidos_estaticos';

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

	public static function leer($nombre, $campos = '*') {
		return DB::select($campos)
						->from(self::$_tabla)
						->where('nombre','LIKE',$nombre)
						->order_by('nombre','asc')
						->execute();	
	}

	public static function editar($id, $cambios) {
		if (!is_array($cambios)) {
			return false;
		}
		$cont = self::leer($id)->current();
		$nombre = $cont['nombre'];
		$delta = array_diff($cambios, $cont);
		unset($delta['nombre']);
		if (empty($delta)) {
			return true;
		}

		$res = DB::update(self::$_tabla)
						->set($delta)
						->where('nombre','LIKE',$nombre);
		
		return !!$res->execute();
	}

	public static function agregar(array $datos) {
		if (empty($datos['nombre']) || empty($datos['texto-md'])) {
			return false;
		}

		$insert = DB::insert(self::$_tabla)
							->columns(array_keys($datos))
							->values($array_values($datos));
		return $insert->execute();
	}

	public static function eliminar($nombre) {
		return (bool) DB::delete($this->_tabla)
									->where('nombre','LIKE',$nombre)
									->execute();
	}
}
