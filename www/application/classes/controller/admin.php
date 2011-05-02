<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller {
	protected $_V;

	public function before() {
		$this->_V = View::factory('plantillas/default');	
	}

	public function action_modificar_sitio_configs() {
		if($this->request->method() == Request::POST) {
			$post = filter_var_array($this->request->post(), FILTER_SANITIZE_STRING);
			
			foreach($post as $llave => $valor) {
				Sitio::config($llave, $valor);
			}
		}

		$this->request->redirect('/cuenta#configuracion');
	}
}
