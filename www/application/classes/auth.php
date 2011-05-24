<?php defined('SYSPATH') or die('No direct access allowed.');

class Auth {
	protected static $_sesion_nombre = 'sesion_radioiit';

	public static function esta_auth() {
		// Si existe la cookie
		if(!empty($_COOKIE) AND !empty($_COOKIE[self::$_sesion_nombre])) {
			$cookie_sid =$_COOKIE[self::$_sesion_nombre]['sid'];
			$res = Model_Usuarios::seleccionar(array(array('sesion_id','=',$cookie_sid)), 'id');
			if(count($res) == 1) {
				return true;
			}
		}

		return false;
	}

	public static function usuario() {
		return (self::esta_auth())
					? Model_Usuarios::seleccionar(array(array('sesion_id','=',$_COOKIE[self::$_sesion_nombre])))
						->current()
					: null;
	}

	public static function identifica($usuario, $contra, $con_encripto = FALSE) {
		$u = Model_Usuarios::leer($usuario);

		//si la contrasena ya viene encriptada
		$contra = ($con_encripto === TRUE) ? $contra : sha1($contra);

		if (count($u) == 1 && $u->get('contrasena') === $contra) { //a crear la sesion
			$u = $u->current();
			//la id de la session
			$sid = sha1($u['id'].time().$u['usuario'].time().$usuario['contrasena'].time());
			//guardarlo an la cookie
			setcookie(self::$_sesion_nombre.'[sid]',$sid,0,Kohana::$base_url);
			//*save sid in db
			$res = Model_Usuarios::editar((int) $u['id'], array('sesion_id'=>$sid));

			return $res;
		}

		return false;
	}

	public static function cerrar_sesion() {
		if(!empty($_COOKIE) AND !empty($_COOKIE[self::$_sesion_nombre])) {
			$sid = $_COOKIE[self::$_sesion_nombre]['sid'];
			//remover la sesion de la cookie
			$res = setcookie(self::$_sesion_nombre.'[sid]','',-3600,Kohana::$base_url);

			//remover de la base de datos
			//no es necesario. si no esta en la cookie no logea
			//$res = Model_Usuarios::editar((int) $u['id'], array('sesion_id'=>$sid));

			return $res;
		}

		return true;
	}

	public static function registrar($usuario, $contra, $email = '', $rol = 'normal') {
		$u = Model_Usuarios::leer($usuario);
		$datos = array(
			'usuario'=>$usuario,
			'contrasena'=>sha1($contra),
			'email'=>$email,
			'rol'=>$rol,
		);
		$creado = (count($u) > 0) ? false : Model_Usuarios::agregar($datos);
		if($creado) {
			$u = Model_Usuarios::leer($usuario)->current();
			//a mandarle el email de validacion
			$msg = <<<email
###Bienvenido a RadioIIT.

Para terminar tu registro, dale click al link para verificar tu email.

[::link::](::link::)
email;

			$msg = Markdown(str_replace('::link::', URL::base('http').'cuenta/validar/'.$u['id'], $msg));
			$de = Sitio::config('email_para_recibir_recomendaciones');
			$headers = "From: ".$de."\r\n";
			$headers .= "Reply-To: ".$de."\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";	

			return mail($email, 'Validar registro a RadioIIT', $msg, $headers);
		}

		return false;
	}
}
