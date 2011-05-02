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
	public static function intervalo_de_tiempos() {
		$t = $t_inicio = strtotime('2000-1-1 00:00:00');
		$t_final = strtotime('2000-1-1 :59:59');
		$tiempos = array($t);
		while($t < $t_final) {
			$t += 15 * Date::MINUTE;
			$tiempos[] = $t;
		}
		$tiempos[] = $t_final;
		return $tiempos;
	}

	/**
	 * toda las canciones que caen en el horario
	 * $id => id del horario si es null usa el horario actual
	 * $sin_pasadas => boolean de si filtra las canciones que no se pueden tocar pedir porque acaban 
	 * de tocarse.
	 */
	public static function canciones($id = null, $sin_pasadas = false) {
		//TODO
	}

	/**
	 * checa si el horario que le pasan superposiciona con alguno en
	 * la base de datos.
	 */
	public static function se_superposiciona($dia,$t_inicial,$t_final) {
		//TODO
		return false;
	}
}
