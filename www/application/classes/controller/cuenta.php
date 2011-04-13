<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Cuenta extends Controller {
	protected $_V;

	public function before() {
		$this->_V = View::factory('plantillas/default');
	}

	public function action_index() {
		$this->_V->set('contenido', 'tu cuenta y lo administrativo esta aqui');
		$this->response->body($this->_V);
	}

	public function action_login() {
		$hay_errores = false;
		$msg = '';
		if($this->request->method() == Request::POST) {
			//filtramos datos de entrada
			$post = $this->request->post();
			$post['usuario'] = filter_var($post['usuario'],
																		FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
			$post['contrasena'] = filter_var($post['contrasena'], FILTER_SANITIZE_STRING);

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

			if ($hay_errores) { //si hay errores a decirle al usuario
				$this->_basico_v->set('cont_principal', $msg)
												->set('cont_auxiliar', View::factory('bloques/login'));
				$this->_V->set('contenido', $this->_basico_v);
				$this->response->body($this->_V);
			} else { //no hay errores de datos, a identificarlo en el sistema
				if (Auth::identifica($post['usuario'], $post['contrasena'])) {
					//redireccionarlo a donde estaba
					$this->request->redirect($this->request->referrer());
				} else { //hubo un error al procesar la identificacion
					$msg .= Markdown(Model_Contenidos::leer('login.error-identificar')->get('texto_md'));
					$this->_basico_v->set('cont_principal', $msg)
													->set('cont_auxiliar', View::factory('bloques/login'));
					$this->_V->set('contenido', $this->_basico_v);
					$this->response->body($this->_V);
				}
			}
		}
	}

	public function action_registrate() {
	}

	public function action_logout() {
		if (Auth::cerrar_sesion()) { //redireccionar a donde estaban
			$this->request->redirect($this->request->referrer());
		} else { //decirles que hubo un error
			$msg = Markdown(Model_Contenidos::leer('login.error-login')->get('texto_md'));
			$basico_v = View::factory('paginas/basica')
									->set('cont_principal', $msg)
									->set('cont_auxiliar', View::factory('bloques/login'));
			$_V = View::factory('plantillas/default')
						->set('contenido', $basico_v);
			$this->response->body($_V);
		}
	}
}
