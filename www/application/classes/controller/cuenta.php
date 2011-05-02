<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Cuenta extends Controller {
	protected $_V;
	protected $_basica_v;

	public function before() {
		$this->_V = View::factory('plantillas/default')
			->set('usarjquery', true)
			->set('scripts', array('media/js/generales.js', 'media/js/cuenta.js'));
		$this->_basica_v = View::factory('paginas/basica');
	}

	public function action_index() {
		if (Auth::esta_auth()) {
			$u = Auth::usuario();
			$princ = View::factory('paginas/dashboard')
				->set('es_admin', ($u['rol'] == 'admin'));
			$aux = HTML::anchor(URL::site('cuenta/logout'), 'Logout');
		} else {
			$princ = View::factory('bloques/login');
			$aux = '';
		}
		$this->_basica_v->set('cont_principal', $princ)->set('cont_auxiliar', $aux);
		$this->_V->set('contenido', $this->_basica_v);
		$this->response->body($this->_V);
	}

	public function action_cambiar_contrasena() {
		//tODO
		if($this->request->method() == Request::POST) {
			//agarrar datos
			$post = $this->request->post();
			$actual = filter_var($post['contrasena_actual'], FILTER_SANITIZE_STRING);
			$nueva = filter_var($post['nueva_contrasena'], FILTER_SANITIZE_STRING);
			$repetida = filter_var($post['nueva_contrasena_repetida'], FILTER_SANITIZE_STRING);
			$hay_errores = false;
			$u = Auth::usuario();
			
			if (sha1($actual) !== $u['contrasena']) {
				$msg = 'La contrase&ntilde;a que pusiste como actual no es la misma.
					[Trate de nuevo]('.$this->request->referrer().').';
				$hay_errores = true;
			}

			if ($nueva !== $post['nueva_contrasena']
				|| $repetida !== $post['nueva_contrasena_repetida']) {
					//caracteres invalidos
					$msg = 'Contrase&ntilde;a tiene caracteres invalidos.'.
						'[Trate de nuevo]('.$this->request->referrer().').';
					$hay_errores = true;
			}

			if($repetida === $nueva && !$hay_errores) {
				//bien a cambiarla
				$res = Model_Usuarios::editar((int) $u['id'], array('contrasena'=>sha1($nueva)));

				$msg = ($res)
						 ? 'Contrase&ntilde;a cambiada. [Regresar]('.
									$this->request->referrer().').'
						 : 'Hubo un error al cambiar la contrase&ntilde;a. [Trate de nuevo]('.
									URL::site('cuenta').').\n\n'.
									'Si continua teniendo el error, contacte al administrador.';
			}

			$this->_V->set('contenido', Markdown($msg));
			$this->response->body($this->_V);
		}
		else {
			$this->request->redirect($this->request->referrer());
		}

	}

	public function action_eliminar() {
		$u = Auth::usuario();
		$admins = Model_Usuarios::seleccionar(array('rol','=','admin'))->count();
		if($u['rol'] == 'admin' && $admins > 1) {
			$res = Model_Usuarios::eliminar((int) $u['id']);
			$msg = $res 
					 ? 'Tu cuenta ha sido eliminada permanentemente.'
					 : 'Un error ocurrio al tratar de eliminar tu cuenta.
							Contacte al administrador si continua teniando problemas.';
		}
		else {
			$msg = 'No se puede borrar tu cuenta porque eres el unico admin que existe.';
		}
		
		$this->_basica_v->set('cont_principal', Markdown($msg))
			->set('cont_auxiliar', '');
			
		$this->response->body($this->_V->set('contenido', $this->_basica_v));
	}


	/**
	 * login, logout y registrase
	 */

	/**
	 * Solo usara para procesar el login del usuario
	 */
	public function action_login() {
		$hay_errores = false;
		$msg = '';
		if($this->request->method() == Request::POST) {
			//filtramos datos de entrada
			$post = $this->request->post();
			$post['usuario'] = filter_var($post['usuario'],
																		FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
			$post['contrasena'] = filter_var($post['contrasena'], FILTER_SANITIZE_STRING);
			//Kohana::$log->add(LOG::DEBUG, 'login: got input');

			//preguntamos por usuario
			$usuario = Model_Usuarios::leer($post['usuario'])->current();
			if(empty($usuario)) {//usuario no existe le dicimos al usuario
				$tmp = Model_Contenidos::leer('login.no-existe')->get('texto_md');
				$msg .= Markdown(str_replace('::usuario::', $post['usuario'], $tmp));
				$hay_errores = true;
			}

			if($usuario['contrasena'] !== sha1($post['contrasena'])) { //las contrasenas son differentes
				$msg .= PHP_EOL.Markdown(Model_Contenidos::leer('login.mal-contrasena')->get('texto_md'));
				$hay_errores = true;
			}
			//Kohana::$log->add(LOG::DEBUG, 'login: checking for input errors');

			if ($hay_errores) { //si hay errores a decirle al usuario
				//Kohana::$log->add(LOG::DEBUG, 'login: hubo errores, a ensellarlos.');
				$this->_basica_v->set('cont_principal', $msg)
												->set('cont_auxiliar', View::factory('bloques/login'));
				$this->_V->set('contenido', $this->_basica_v);
				$this->response->body($this->_V);
			} else { //no hay errores de datos, a identificarlo en el sistema
				if (Auth::identifica($post['usuario'], $post['contrasena'])) {
					//Kohana::$log->add(LOG::DEBUG, 'login: autentificado!');
					//redireccionarlo a donde estaba
					$this->request->redirect('/cuenta');
				} else { //hubo un error al procesar la identificacion
					//Kohana::$log->add(LOG::DEBUG, 'login: error al autentificar');
					$msg .= Markdown(Model_Contenidos::leer('login.error-identificar')->get('texto_md'));
					$this->_basica_v->set('cont_principal', $msg)
													->set('cont_auxiliar', View::factory('bloques/login'));
					$this->_V->set('contenido', $this->_basica_v);
					$this->response->body($this->_V);
				}
			}
		}
	}

	public function action_registrate() {
		require Kohana::find_file('vendors', 'recaptcha-php/recaptchalib');
		$hay_errores = false;
		$msg = '';
		$post = $this->request->post();
		$mini_msg = View::factory('bloques/mini-msg');
		$basico_v = View::factory('paginas/basica')
								->set('cont_principal', '')
								->set('cont_auxiliar', '');
		if(!empty($post)) { //si quieren registrarse
			//filtramos datos de entrada
			$post['usuario'] = filter_var($post['usuario'],
																		FILTER_SANITIZE_SPECIAL_CHARS
																		|FILTER_SANITIZE_STRING);
			$post['contrasena'] = filter_var($post['contrasena'], FILTER_SANITIZE_STRING);
			$post['recaptcha_response_field'] = filter_var($post['recaptcha_response_field'],
																											FILTER_SANITIZE_STRING);
					
			//datos son validos
			if(strlen($post['usuario']) < 4 || empty($post['usuario'])) {
				$msg .= $mini_msg->set('contenido', 'Usuario necesita tener por lo menos 4 caracteres.');
				$hay_errores = true;
			}
			if(strlen($post['contrasena']) < 6 || empty($post['contrasena'])) {
				$msg .= $mini_msg->set('contenido', 'La contrase&ntilde;a necesita por lo menos tener 6 caracteres');
				$hay_errores = true;
			}
			if (!isset($post['recaptcha_response_field'])
				 || empty($post['recaptcha_response_field'])) {
				$msg .= $mini_msg->set('contenido','Se necesita una respuesta en el captcha.');
				$post['recaptcha_response_field'] = '';
				$hay_errores = true;
			}

			//check captcha
			$resp = recaptcha_check_answer(Sitio::recaptcha_llave_privada(),
																		 $_SERVER['REMOTE_ADDR'],
																		 $post['recaptcha_challenge_field'],
																		 $post['recaptcha_response_field']);
			if(!$resp->is_valid) {
				$msg .= $mini_msg->set('contenido','Se necesita una respuesta en el captcha.');
				$hay_errores = true;
			}

			if(!$hay_errores) {
				if(Auth::registrar($post['usuario'], $post['contrasena'])) {
					$msg .= $mini_msg->set('contenido','Usuario '.$post['usuario'].' fue registrado.')
									->set('clase','nada');
				} else {
					$msg .= $mini_msg->set('contenido','Usuario '.$post['usuario'].' ya existe. Trate de nuevo.');
				}
			}
		
		}
		//no han mandado el los datos de registro
		//ha ensenar el formulario
		$msg .= View::factory('bloques/pre-recaptcha');
		$msg .= View::factory('bloques/registro')
						->set('recaptcha', recaptcha_get_html(Sitio::recaptcha_llave_publica()));
	
		$basico_v->set('cont_principal', $msg);
		$this->_V->set('contenido', $basico_v);
		$this->response->body($this->_V);
	}

	public function action_logout() {
		if (Auth::cerrar_sesion()) { //redireccionar a donde estaban
			$this->request->redirect($this->request->referrer());
		} else { //decirles que hubo un error
			$msg = Markdown(Model_Contenidos::leer('login.error-login')->get('texto_md'));
			$basico_v = View::factory('paginas/basica')
									->set('cont_principal', $msg)
									->set('cont_auxiliar', View::factory('bloques/login'));
			$this->_V->set('contenido', $basico_v);
			$this->response->body($this->_V);
		}
	}
}
