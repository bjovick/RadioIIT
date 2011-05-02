<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller {
	protected $_V;

	public function before() {
		$this->_V = View::factory('plantillas/default');	
	}

	public function action_modificar_sitio_configs() {
		if($this->request->method() == Request::POST) {
			$post = filter_var_array($this->request->post(), FILTER_SANITIZE_STRING);
			$post['email_admin'] = filter_var($post['email_admin'], FILTER_SANITIZE_EMAIL);
			
			foreach($post as $llave => $valor) {
				Sitio::config($llave, $valor);
			}
		}

		$this->request->redirect('/cuenta#configuracion');
	}

	public function action_agregar_usuario(){
		if($this->request->method() == Request::POST) {
			$post = filter_var_array($this->request->post(), FILTER_SANITIZE_STRING);	
			$post['usuario'] = filter_var($post['usuario'], FILTER_SANITIZE_SPECIAL_CHARS);
			
			$res = Model_Usuarios::agregar(array(
				'usuario' => $post['usuario'],
				'contrasena' => sha1($post['nueva_contrasena']),
				'rol' => empty($post['rol']) ? 'normal' : $post['rol'],
			));
		
			$this->request->redirect('/cuenta#usuarios');
		}

		$this->_V->set('contenido', View::factory('bloques/modificar_usuario')
				->set('modificar', false)->set('accion', URL::site('/admin/agregar_usuario')));
		$this->response->body($this->_V);
	}

	public function action_eliminar_usuario() {
		if($this->request->method() == Request::POST) {
			$post = filter_var_array($this->request->post(), FILTER_SANITIZE_NUMBER_INT);	
			if(!Model_Usuarios::eliminar((int) $post['id'])) {
				$this->_V->set('cotenido', Markdown('Un error ocurrio al tratar de eliminar el usuario.'));
				$this->response->body($this->_V);
				return;
			}
		}

		$this->request->redirect('/cuenta#usuarios');
	}

	public function action_modificar_usuario($cambios = null) {
		if($this->request->method() == Request::POST) {
			$post = filter_var_array($this->request->post(), FILTER_SANITIZE_STRING);
			if(is_null($cambios)) {//pidieron el formulario para editar
				$this->_V->set('contenido', View::factory('bloques/modificar_usuario')
																		->set('id', (int) $post['id']));
				$this->response->body($this->_V);
			}
			else { //mandaron cambios
				$usu = Model_Usuarios::leer((int) $post['id'])->current();
				$deltas = array();
				
				if($post['usuario'] !== $usu['usuario']) {
					$deltas['usuario'] = $post['usuario'];
				}

				if (!empty($post['nueva_contrasena'])
					 && !empty($post['nueva_contrasena_repetida'])
					 && strlen($post['nueva_contrasena']) === strlen($post['nueva_contrasena_repetida'])
					 && strlen($post['nueva_contrasena']) > 5) {
					$deltas['contrasena'] = sha1($post['nueva_contrasena']);
				}

				if ($post['rol'] !== $usu['rol']) {
					$deltas['rol'] = $post['rol'];
				}

				$res = 'nada';
				if(!empty($deltas)) {
					$res = Model_Usuarios::editar((int) $post['id'], $deltas);
				}

				$this->request->redirect('/cuenta#usuarios');
				/** Depuracion
				echo '<pre>'.
					'usu: '.var_export($usu, true).PHP_EOL.
					'post: '.var_export($post, true).PHP_EOL.
					'deltas: ['.var_export($res,true).'] '.var_export($deltas, true).PHP_EOL.
					'nuevo: '.var_export(Model_Usuarios::leer((int) $post['id'])->current(), true).PHP_EOL.
					'</pre>';
				*/
			}
		}
		else {
			$this->request->redirect('/cuenta#usuarios');
		}
	}

	public function action_eliminar_horario() {
		if($this->request->method() == Request::POST) {
			$post = filter_var_array($this->request->post(), FILTER_SANITIZE_NUMBER_INT);	
			if(!Model_Horarios::eliminar((int) $post['id'])) {
				$this->_V->set('cotenido', Markdown('Un error ocurrio al tratar de eliminar el horario.'));
				$this->response->body($this->_V);
				return;
			}
		}

		$this->request->redirect('/cuenta#horarios');
	}

	public function action_modificar_horarios($cambios) {
		if($this->request->method() == Request::POST) {
			$post = filter_var_array($this->request->post(), FILTER_SANITIZE_STRING);
			if(is_null($cambios)) {//pidieron el formulario para editar
				$this->_V->set('contenido', View::factory('bloques/modificar_horario')
																		->set('id', (int) $post['id']));
				$this->response->body($this->_V);
			}
			else { //mandaron cambios
				$usu = Model_Horarios::leer((int) $post['id'])->current();
				$deltas = array();

				if($post['usuario'] !== $usu['usuario']) {
					$deltas['usuario'] = $post['usuario'];
				}

				if (!empty($post['nueva_contrasena'])
					 && !empty($post['nueva_contrasena_repetida'])
					 && strlen($post['nueva_contrasena']) === strlen($post['nueva_contrasena_respendida'])
					 && strlen($post['nueva_contrasena']) > 5) {
					$deltas['contrasena'] = $post['nueva_contrasena'];
				}

				if ($post['rol'] !== $usu['rol']) {
					$deltas['rol'] = $post['rol'];
				}


				if(!empty($deltas)) {
					Model_Usuarios::editar((int) $post['id'], $deltas);
				}
			}

		}
		
		$this->request->redirect('/cuenta#horarios');
	}
}
