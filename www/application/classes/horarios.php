<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Clase de utilidades basicas de horarios
 */
class Horarios {
	protected static $_tabla = 'horarios';
	public static $dias = array(
		'domingo', 'lunes', 'martes',
		'miercoles', 'jueves', 'viernes',
		'sabado');

	/**
	 * regresa el horario actual en forma de array
	 */
	public static function actual() {
		list($dia_n,$tiempo) = explode(' ', date('w H:i:s', time()));

		$filtros = array(
			array('dia', '=', self::$dias[$dia_n]),
			array('tiempo_inicial', '<=', $tiempo),
			array('tiempo_final', '>=', $tiempo)
		);

		return Model_Horarios::seleccionar($filtros)->current();
	}

	/**
	 * regresa un array con los intervalos permitidos del dia
	 * en que se puede iniciar o terminar un horario.
	 * los intervalos son timestamps para que las comparaciones
	 * sean numericas y mas especificas y se usa el primero de 
	 * enero del 2000 como dia base. dia escojido al azar
	 */
	public static function intervalos_de_tiempo() {
		$t = $t_inicio = strtotime('2000-1-1 00:00:00');
		$t_final = strtotime('2000-1-1 23:59:59');
		$tiempos = array($t);
		while($t < $t_final) {
			$t += 15 * Date::MINUTE;
			$tiempos[] = $t;
		}
		$tiempos[(count($tiempos)-1)] = $t_final;
		return $tiempos;
	}

	public static function canciones_mas_pedidas($limite = 10) {
		$h = self::actual();
		$generos = explode(',',$h['generos']);

		return DB::select('*')->from('canciones')
			->where('genero','IN',DB::expr('(\''.implode('\',\'', $generos).'\')'))
			->order_by('cantidad_pedidas', 'desc')
			->limit($limite)->execute();
	}

	/**
	 * checa si el el dia y las horas que le pasan conflictan con alguno en
	 * la base de datos.
	 */
	public static function conflicta_con($dia,$t_inicial,$t_final, array $excepciones = array()) {
		$culpables = DB::select('id')->from('horarios')
			->where('dia','=',$dia)
			->where_open()
				->where('tiempo_final', '>=', $t_inicial)
				->and_where('tiempo_inicial', '<=', $t_final)
			->where_close();
		if(!empty($excepciones)) {
			$culpables->where('id','NOT IN', DB::expr('('.implode(',',$excepciones).')'));
		}
		/*
		SELECT id FROM horarios
		WHERE dia='jueves'
		AND ('08:15:00' <= tiempo_final AND '19:00:00' >= tiempo_inicial)
		 */

		return $culpables->execute()->count() > 0;
	}
}
