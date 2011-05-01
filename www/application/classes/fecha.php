<?php defined('SYSPATH') or die('No direct script access.');

class Fecha {
	/**
	 * regresa el lapso transcurrido en lenguage natural
	 */
	public static function lapso_difuso($timestamp, $ts_local = null) {
    $ts_local = is_null($ts_local) ? time() : (int) $ts_local;
 
		//determinar la diferencia en segundos
    $offset = abs($local_timestamp - $timestamp);
 
    if ($offset <= Date::MINUTE)
    {
        $lapso = 'instantes';
    }
    elseif ($offset < (Date::MINUTE * 20))
    {
        $lapso = 'unos minutos';
    }
    elseif ($offset < Date::HOUR)
    {
        $lapso = 'menos de una hora';
    }
    elseif ($offset < (Date::HOUR * 4))
    {
        $lapso = 'un par de horas';
    }
    elseif ($offset < Date::DAY)
    {
        $lapso = 'menos de un d&iacute;a';
    }
    elseif ($offset < (Date::DAY * 2))
    {
        $lapso = 'alrededor de un d&iacute;a';
    }
    elseif ($offset < (Date::DAY * 4))
    {
        $lapso = 'un par de d&iacute;as';
    }
    elseif ($offset < Date::WEEK)
    {
        $lapso = 'menos de una semana';
    }
    elseif ($offset < (Date::WEEK * 2))
    {
        $lapso = 'alrededor de una semana';
    }
    elseif ($offset < Date::MONTH)
    {
        $lapso = 'menos de un mes';
    }
    elseif ($offset < (Date::MONTH * 2))
    {
        $lapso = 'alrededor de un mes';
    }
    elseif ($offset < (Date::MONTH * 4))
    {
        $lapso = 'un par de meses';
    }
    elseif ($offset < Date::YEAR)
    {
        $lapso = 'menos de un a&ntilde;o';
    }
    elseif ($offset < (Date::YEAR * 2))
    {
        $lapso = 'alrededor de un a&ntilde;o';
    }
    elseif ($offset < (Date::YEAR * 4))
    {
        $lapso = 'un par de a&ntilde;os';
    }
    elseif ($offset < (Date::YEAR * 8))
    {
        $lapso = 'unos a&ntilde;os';
    }
    elseif ($offset < (Date::YEAR * 12))
    {
        $lapso = 'alrededor de una d&eacute;cada';
    }
    elseif ($offset < (Date::YEAR * 24))
    {
        $lapso = 'un par de d&eacute;cadas';
    }
    elseif ($offset < (Date::YEAR * 64))
    {
        $lapso = 'varias d&eacute;cadas';
    }
    else
    {
        $lapso = 'mucho tiempo';
    }
 
    if ($timestamp <= $ts_local)
    {
				//paso en el pasado
        return 'hace '.$lapso;
    }
    else
    {
				//paso en el futuro
        return 'en '.$lapso;
    }
	}

	/**
	 * lapso en idioma natural pero solo si es dentro de un par de horas
	 * lo demas se pone como fecha normal
	 */
	public static function lapso_corto_nat($timestamp, $ts_local = null) {
	    $ts_local = is_null($ts_local) ? time() : (int) $ts_local;
 
		//determinar la diferencia en segundos
    $offset = abs($local_timestamp - $timestamp);
		$pura_fecha = false;
 
    if ($offset <= Date::MINUTE)
    {
        $lapso = 'instantes';
    }
    elseif ($offset < (Date::MINUTE * 20))
    {
        $lapso = 'unos minutos';
    }
    elseif ($offset < Date::HOUR)
    {
        $lapso = 'menos de una hora';
    }
    elseif ($offset < (Date::HOUR * 4))
    {
        $lapso = 'un par de horas';
    }
    else
    {
				$pura_fecha = true;
        $lapso = self::fecha($timestamp);
    }
 
    if (!$pura_fecha)
    {
				$lapso = (($timestamp <= $ts_local) ? 'hace ' : 'en ').$lapso
    }

		return $lapso;
	}

	public static function fecha($ts_fecha) {
		if(is_string($ts_fecha)) { //es una fecha
			$ts_fecha = strtotime($ts_fecha);
		}
		
		return is_integer($ts_fecha) ? date("Y.m.d g:ia",strtotime($ts_fecha)) : $ts_fecha;
	}
}
