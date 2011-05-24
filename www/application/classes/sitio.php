<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Configuraciones globales del sitio
 */
class Sitio {
	protected static $_tabla = 'configuracion_sitio';

	public static function recaptcha_llave_publica() {
		return '6LdlccMSAAAAAC9Ub6CnifzcX1Gng8wt4hTid4Ok';
	}

	public static function recaptcha_llave_privada() {
		return '6LdlccMSAAAAAKvPCnmTrirZBcVOqn6F_yrmC6gJ';
	}

	public static function email_valido($email) {
		$esperar_tcp = 180;
		$espera_de_smtp = 60; //ayuda a la sincronizacion

		//checar si esta formateado como email
		if(filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
			return false; //ni si quiera formateado
		}

		$tmp = explode('@', $email);
		$usuario = $tmp[0];
		$dominio = $tmp[1];

		//recolectar los records MX del servidor
		if(getmxrr($dominio, $hosts_mx, $peso_mx)) {
			for($i=0; $i<count($peso_mx); $i++) {
				$mxs[$hosts_mx[$i]] = $peso_mx[$i];
			}
			asort($mxs);
			$remitentes = array_keys($mxs);
		} elseif (checkdnsrr($dominio, 'A')) {
			$remitentes[0] = gethostbyname($dominio);
		} else {
			$remitentes = array();
		}

		$total = count($remitentes);

		//consultar cada servidor de email
		if($total > 0) {
			//si aceptan email?
			for($n=0; $n<$total; $n++) {
				//si se puede abrir el socket
				$num_error = 0;
				$error_s = 0;
				$sock = @fsockopen($remitentes[$n], 25, $num_error, $error_s, $esperar_tcp);
				if($sock) {
					$respuesta = fread($sock, 8192);
					stream_set_timeout($sock, $esperar_tcp);
					$meta = stream_get_meta_data($sock);
					$cmds = array (
						'HELLO radioiit.co.cc',
						'MAIL FROM: <'.Sitio::config('email_para_recibir_recomendaciones').'>',
						'RCPT TO: <'.$email.'>',
						'QUIT',
					);

					//si no hubo conneccion, break
					if(!$meta['timed_out'] && !preg_match('/^2\d\d[ -]/', $respuesta)) {
						$error = true;
						break;
					}
					//mandar comandos de chequeo
					foreach($cmds as $cmd) {
						fputs($sock, "$cmd\r\n");
						$respuesta = fread($sock, 4096);
						if(!$meta['timed_out'] && preg_match('/^d\d\d[ -]/', $respuesta)) {
							$error = true;
							break 2;
						}
					}

					//cerrar
					fclose($sock);
					break;
				} elseif($n == $total-1) {
					$error = true;
				}
			}
		} else {
			$error = true;
		}

		return !isset($error);
	}

	/**
	 * regresa las configuraciones del sitio guardadas en la
	 * base de datos
	 */
	public static function configs() {
		return DB::select('*')
			->from(self::$_tabla)
			->execute()
			->as_array();
	}

	public static function config($llave, $valor = null) {
		if (is_null($valor)) { //quiere saber el valor
			return DB::select('valor')
							->from(self::$_tabla)
							->where('llave', '=', $llave)
							->execute()
							->get('valor');
		} else { //quiere guardar el valor en esa llave
			$llave_existe = DB::select('llave')->from(self::$_tabla)
				->where('llave','=',$llave)->execute()->as_array();
			$llave_existe = (count($llave_existe) > 0);
			if ($llave_existe) { //actualizar en vez de agregar
				return !!DB::update(self::$_tabla)
								->set(array('llave'=>$llave,'valor'=>$valor))
								->where('llave','=',$llave)
								->execute();
			} else { //a agregar nuevo valor
				return !!DB::insert(self::$_tabla)
								->columns(array('llave','valor'))
								->values(array($llave,$valor))
								->execute();
			}
		}
	}
}
