<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller {
	protected $_V;

	public function before() {
		$this->_V = View::factory('plantillas/default');	
	}

	public function action_modificar_sitio_configs() {
		if($this->request->method() == Request::POST) {
			$post = filter_var_array($this->request->post(), FILTER_SANITIZE_STRING);
			$post['email_para_recibir_recomendaciones'] =
				filter_var($post['email_para_recibir_recomendaciones'], FILTER_SANITIZE_EMAIL);

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

			if(count(Model_Usuarios::leer($post['usuario'])) == 0) {
				$res = Model_Usuarios::agregar(array(
					'usuario' => $post['usuario'],
					'contrasena' => sha1($post['nueva_contrasena']),
					'rol' => empty($post['rol']) ? 'normal' : $post['rol'],
				));

				$this->request->redirect('/cuenta#usuarios');
			}
			else {
				$v = View::factory('plantillas/default')
					->set('contenido', Markdown('El usuario ya existe'));
				$this->response->body($v);
			}
		}
		else {
			$this->_V->set('contenido', View::factory('bloques/modificar_usuario')
					->set('modificar', false)->set('accion', URL::site('/admin/agregar_usuario')));
			$this->response->body($this->_V);
		}
	}

	public function action_eliminar_usuario() {
		if($this->request->method() == Request::POST) {
			$post = filter_var_array($this->request->post(), FILTER_SANITIZE_NUMBER_INT);	
			if(!Model_Usuarios::eliminar((int) $post['id'])) {
				$this->_V->set('cotenido', Markdown('Un error ocurrio al tratar de eliminar el usuario.'));
				$this->response->body($this->_V);
			}
			else {
				$this->request->redirect('/cuenta#usuarios');
			}
		}
		else {
			$this->request->redirect('/cuenta#usuarios');
		}
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
			}
			else {
				$this->request->redirect('/cuenta#horarios');
			}
		}
		else {
			$this->request->redirect('/cuenta#horarios');
		}
	}

	public function action_modificar_horario($cambios = null) {
		if($this->request->method() == Request::POST) {
			$post = filter_var_array($this->request->post(), FILTER_SANITIZE_STRING);
			if(is_null($cambios)) {//pidieron el formulario para editar
				$horarios = '<h4>Horarios existentes</h4>'.PHP_EOL.'<ul>'.PHP_EOL;
				foreach(Model_Horarios::navegar()->as_array() as $hor) {
					$horarios .= '<li>'.$hor['dia'].': '.
												Fecha::hora_nat($hor['tiempo_inicial']).' &ndash; '.
												Fecha::hora_nat($hor['tiempo_final']).'</li>'.PHP_EOL;
				}
				$horarios .= '</ul>';
				$basica = View::factory('paginas/basica')
					->set('cont_principal', View::factory('bloques/modificar_horario')->set('id',(int) $post['id']))
					->set('cont_auxiliar', $horarios);
				$this->_V->set('contenido', $basica)
					->set('usarjquery', true)
					->set('scripts', array('media/js/generales.js'));
			}
			else { //mandaron cambios
				$hor = Model_Horarios::leer((int) $post['id'])->current();
				$gs = ($post['generos'] == array('')) ? array() : $post['generos'];
				if(!empty($gs)) {
					$gs = array_values(array_flip(array_flip($post['generos'])));
				}
				$post['generos'] = implode(',',$gs);

				$deltas = array_diff($post,$hor);
				$msg = '';

				//asegurarse que no tengan conflicto de horario
				if(Horarios::conflicta_con($post['dia'],
																	 $post['tiempo_inicial'],
																	 $post['tiempo_final'],
																	 array($post['id']))) {
					$msg.= 'El los cambios de horario conflicta con otro horario.';
				}
				else {
					if(!empty($deltas)) {
						if(Model_Horarios::editar((int) $post['id'], $deltas)) {
							$this->request->redirect('/cuenta#horarios');
						}
						else {
							$msg.= 'Hubo un problema al editar el horario. Si el problema existe contacte al administrador.';
						}						
					}
					else {
						$this->request->redirect('/cuenta#horarios');
					}
				}

				$msg = Markdown($msg);
				$this->_V->set('contenido',$msg);
			}

			$this->response->body($this->_V);
		}
		else {
			$this->request->redirect('/cuenta#horarios');
		}
	}

	public function action_agregar_horario() {
		if($this->request->method() == Request::POST) {
			$post = filter_var_array($this->request->post(), FILTER_SANITIZE_STRING);
			$gs = ($post['generos'] == array('')) ? array() : $post['generos'];
			if(!empty($gs)) {
				$gs = array_values(array_flip(array_flip($post['generos'])));
			}
			$post['generos'] = implode(',',$gs);

			//asegurarse que no conflicte con otro
			if (!empty($post['generos'])
				 && !empty($post['dia'])
				 && !empty($post['tiempo_inicial'])
				 && !empty($post['tiempo_final'])) {
				$res = Model_Horarios::agregar($post);
			}
		
			$this->request->redirect('/cuenta#horarios');
		}
		else {
			$horarios = '<h4>Horarios existentes</h4>'.PHP_EOL.'<ul>'.PHP_EOL;
			foreach(Model_Horarios::navegar()->as_array() as $hor) {
				$horarios .= '<li>'.$hor['dia'].': '.
											Fecha::hora_nat($hor['tiempo_inicial']).' &ndash; '.
											Fecha::hora_nat($hor['tiempo_final']).'</li>'.PHP_EOL;
			}
			$horarios .= '</ul>';
			$basica = View::factory('paginas/basica')
				->set('cont_principal', View::factory('bloques/agregar_horario'))
				->set('cont_auxiliar', $horarios);
			$this->_V->set('contenido', $basica)
				->set('usarjquery', true)
				->set('scripts', array('media/js/generales.js'));
			$this->response->body($this->_V);
		}
	}
}
