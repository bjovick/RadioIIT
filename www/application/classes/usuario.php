<?php defined('SYSPATH') or die('No direct script access.');

class Usuario {
	private function __clone() {
	}

	/**
	 * si pasa los limites regresa true (checar con comparador estricto ===)
	 */
	public static function peticion_es_valida() {
		$ts = time();
		$u = Auth::usuario();
		$l_lapso = intval(Sitio::config('limite_de_tiempo_para_no_de_peticiones_(segs)'));
		$l_cantidad = intval(Sitio::config('no_de_peticiones_permitidas_por_usuario'));
		$peticiones = intval($u['peticiones']);
		$primer_pet = strtotime($u['primer_peticion_en']);

		if ($primer_pet === false || $peticiones === 0) {
			//nunca se ha pedido cancion
			//incrementar numero de peticiones en la bd
			//actualizar el campo primer_peticione_en a este instante
			DB::update('usuarios')
				->set(array(
					'peticiones' => 1,
					'primer_peticion_en' => Fecha::a_bd($ts),
				))
				->where('id','=',$u['id'])
				->execute();
			return true;
		}

		$lapso = $ts - $primer_pet;
		if ($lapso < $l_lapso && $peticiones < $l_cantidad) {
			//esta entre el parametro de lapso y cantidad
			//incrementar el numero de peticiones
			DB::update('usuarios')
				->set(array(
					'peticiones' => DB::expr('`peticiones` + 1'),
				))
				->where('id','=',$u['id'])
				->execute();
			return true;
		}
		if($lapso >= $l_lapso && $peticiones < $l_cantidad) {
			//se paso del tiempo pero no se paso las peticiones
			//re reinicia la cantidad a 1 y el primer_peticion_en a este instante
			DB::update('usuarios')
				->set(array(
					'peticiones' => DB::expr('`peticiones` + 1'),
					'primer_peticion_en' => Fecha::a_bd($ts),
				))
				->where('id','=',$u['id'])
				->execute();
			return true;
		}

		return false;
	}

	/**
	 * si pasa los limites regresa true (checar con comparador estricto ===)
	 */
	public static function recomendacion_es_valida() {
		$ts = time();
		$u = Auth::usuario();
		$l_lapso = intval(Sitio::config('limite_de_tiempo_para_no_de_recomendaciones_(segs)'));
		$l_cantidad = intval(Sitio::config('no_de_recomendaciones_permitidas_por_usuario'));
		$recomends = intval($u['recomendaciones']);
		$primer_rec = strtotime($u['primer_recomend_en']);

		//
		if ($primer_rec === false || $recomends === 0) {
			DB::update('usuarios')
				->set(array(
					'recomendaciones' => DB::expr('`recomendaciones` + 1'),
					'primer_recomend_en' => Fecha::a_bd($ts),
				))
				->where('id','=',$u['id'])
				->execute();
			return true;
		}

		$lapso = $ts - $primer_rec;
		if ($lapso < $l_lapso && $recomends < $l_cantidad) {
			DB::update('usuarios')
				->set(array(
					'recomendaciones' => DB::expr('`recomendaciones` + 1'),
				))
				->where('id','=',$u['id'])
				->execute();
			return true;
		}
		if($lapso >= $l_lapso && $recomends < $l_cantidad) {
			DB::update('usuarios')
				->set(array(
					'recomendaciones' => 1,
					'primer_recomend_en' => Fecha::a_bd($ts),
				))
				->where('id','=',$u['id'])
				->execute();
			return true;
		}

		return false;
	}
}
