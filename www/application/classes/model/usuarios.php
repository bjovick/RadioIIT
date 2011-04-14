<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Usuarios extends Model {
	protected static $_tabla = 'usuarios';

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

		$select->order_by('usuario','asc');

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
			return self::seleccionar(array(array('usuario','=',$idonombre)), $campos);
		} elseif (is_int($idonombre)) { //es id
			return self::seleccionar(array(array('id','=',$idonombre)), $campos);
		}

		return false;
	}

	public static function editar($id, $cambios) {
		if (!is_array($cambios)) {
			return false;
		}
		$cont = self::leer($id)->current();
		$nombre = $cont['usuario'];
		$delta = array_diff($cambios, $cont);
		unset($delta['usuario']);
		if (empty($delta)) {
			return true;
		}

		$res = DB::update(self::$_tabla)
						->set($delta)
						->where('usuario','LIKE',$nombre);
		
		return !!$res->execute();
	}

	public static function agregar(array $datos) {
		//valores basicos
		if (empty($datos['usuario']) || empty($datos['contrasena'])) {
			return false;
		}

		//checar que la contra sea de 6 o mas caracteres
		if(strlen($datos['contrasena']) < 40) {
			return false;
		}

		$insert = DB::insert(self::$_tabla)
							->columns(array_keys($datos))
							->values(array_values($datos));

		return !!$insert->execute();
	}

	public static function eliminar($idnombre) {
		$filtro = is_int($idnombre)
						? array('id','=',$idnombre)
						: array('nombre','=',$idnombre);
		return (bool) DB::delete($this->_tabla)
									->where($filtro[0],$filtro[1],$filtro[2])
									->execute();
	}
}
