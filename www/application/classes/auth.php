<?php defined('SYSPATH') or die('No direct access allowed.');

class Auth {
	protected static $_sesion_nombre = 'sesion_radioiit';

	public static function esta_auth() {
		// Si existe la cookie
		if(!empty($_COOKIE) AND !empty($_COOKIE[self::$_sesion_nombre])) {
			$cookie_sid =$_COOKIE[self::$_sesion_nombre]['sid'];
			$res = Model_Usuarios::seleccionar(array(array('session_id','=',$cookie_sid)), 'id');
			if(count($res) == 1) {
				return true;
			}
		}

		return false;
	}

	public static function usuario() {
		return (self::esta_auth())
					? Model_Usuarios::seleccionar(array(array('session_id','=',$_COOKIE[self::$_sesion_nombre])))
						->current()
					: null;
	}

	public static function identifica($usuario, $contra) {
		$u = Model_Usuarios::leer($usuario);

		if (count($u) == 1 && $u->get('contrasena') === sha1($contra)) {
			//a crear la sesion
			
			//la id de la session
			$sid = sha1($u['id'].time().$u['usuario'].time().$usuario.['contrasena'].time());
			//guardarlo an la cookie
			setcookie(self::$_sesion_nombre.'[sid]',$sid,0,Kohana::$base_url);
			//*save sid in db

			$res = Model_Usuarios::editar((int) $u['id'], array('sesion_id'=>$sid));

		}

		return false;
	}

	public static function cerrar_sesion() {
		if(!empty($_COOKIE) AND !empty($_COOKIE[App::$session_name])) {
			$sid = $_COOKIE[App::$session_name]['sid'];
			//remove the session_id from cookie
			setcookie(App::$session_name.'[sid]','',-3600,Kohana::$base_url);
			//remove sid from db
			$result = DB::update('users')
								->value('session_id','')
								->where('session_id','=',$sid)
								->execute();
		}

		$this->request->redirect('admin');
	}

	public static function registrar($usuario, $contra) {
		//TODO asegurarse primero que no exista otro usuario con ese nombre
		return Model_Usuarios::agregar($usuario, $contra);
	}
}
