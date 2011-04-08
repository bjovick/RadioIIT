<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Login extends Controller {
	protected $_V;
	protected $_basic_v;

	public function before() {
		$this->_V = View::factory('plantillas/default');
		$this->_basico_v = View::factory('paginas/basica');
	}

	public function action_index() {
		if($this->request->method() == Request::POST) {
			$post = $this->request->post();
			$post['usuario'] = filter_var($post['usuario'],
																		FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
			$post['contrasena'] = filter_var($post['contrasena'], FILTER_SANITIZE_STRING);

			$usuario = Model_Usuarios::seleccionar($post['usuario'])->current();
			
			if(empty($usuario)) {//usuario no existe
				$this->_basico_v->set('cont_principal', Markdown(Model_Contenidos
																													::leer('login.no-existe')
																													->get('texto_md')))
												->set('cont_auxiliar', View::factory('bloques/login'));
				$this->_V->set('contenido', $this->_basico_v);
				$this->response->body($this->_V);
				return;
			}

			if($usuario['contrasena'] !== sha1($post['contrasena'])) { //las contrasenas son differentes
			}

			//todo esta bien a identificarlo y crear sesion
			Auth::identificar($post['usuario'], $post['contrasena']);
			//redireccionarlo a donde estaba
			$this->response->redirect($this->request->referrer());
		}
	}

}
