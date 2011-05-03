<?php defined('SYSPATH') or die('No direct script access.');

class Fecha {
	/**
	 * regresa el lapso transcurrido en lenguage natural
	 */
	public static function lapso_difuso($timestamp, $ts_local = null) {
    $ts_local = is_null($ts_local) ? time() : (int) $ts_local;
 
		//determinar la diferencia en segundos
    $offset = abs($ts_local - $timestamp);
 
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
    $offset = abs($ts_local - $timestamp);
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
        $lapso = self::formato($timestamp);
    }
 
    if (!$pura_fecha)
    {
				$lapso = (($timestamp <= $ts_local) ? 'hace ' : 'en ').$lapso;
    }
		
		return $lapso;
	}

	public static function formato($ts_fecha) {
		return date('Y.m.d g:ia', is_string($ts_fecha) ? strtotime($ts_fecha) : $ts_fecha);
	}

	public static function hora_nat($h) {
		$h = (is_string($h) && strlen($h) == 8) ? strtotime('2000-1-1 '.$h) : $h;
		return date('h:ia', $h);
	}
	
	public static function duracion_nat($segundos) {
		if($segundos < Date::MINUTE) {
			$lapso = $segundos.' segundos';
		}
		elseif($segundos == Date::MINUTE) {
			$lapso = '1 minuto';
		}
		elseif($segundos < Date::HOUR) {
			$lapso = ($segundos / Date::MINUTE).' minutos';
		}
		elseif($segundos == Date::HOUR) {
			$lapso = '1 hora';
		}
		elseif($segundos < Date::DAY) {
			$lapso = ($segundos / Date::HOUR).' horas';
		}
		elseif($segundos == Date::DAY) {
			$lapso = '1 d&iacute;a';
		}
		else {
			$lapso = ($segundos / Date::DAY).' d&iacute;as';
		}

		return $lapso;
	}
}
