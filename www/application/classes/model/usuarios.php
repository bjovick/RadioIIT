<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Usuarios extends Model {
	protected static $_tabla = 'usuarios';

	public static function navegar($limite = null, array $filtros = array()) {
	}
	public static function leer($idonombre, $campos = '*') {
		if (is_string($idonombre)) { //es nombre
			return self::seleccionar(array(array('nombre','=','"'.$idonombre.'"')), $campos);
		} elseif (is_int($idonombre)) { //es id
			return self::(array(array('id','=',$idonombre)), $campos);
		}

		return false;
	}
	public static function seleccionar($filtros, $campos) {
		$select = DB::select($campos)->from(self::$_tabla);
		foreach ($filtros as $filtro) {
			$select->where($filtro[0],$filtro[1],$filtro[2]);
		}

		return $select->execute();
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
		//valores basicos
		if (empty($datos['nombre']) || empty($datos['contrasena'])) {
			return false;
		}

		//filtrar email
		if(!empty($datos['email'])) {
			if(($datos['email'] = filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) == FALSE) {
				return false;
			}
		}

		//checar que la contra sea de 6 o mas caracteres
		if(count($datos['contrasena']) < 6) {
			return false;
		}

		$insert = DB::insert(self::$_tabla)
							->columns(array_keys($datos))
							->values($array_values($datos));
		return !!$insert->execute();
	}
	public static function eliminar() {
	}
}
