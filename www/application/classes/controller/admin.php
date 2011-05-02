<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller {
	protected $_V;

	public function before() {
		$this->_V = View::factory('plantillas/default');	
	}

	public function action_modificar_sitio_configs() {
		if($this->request->method() == Request::POST) {
			$post = $this->request->post();
		}
		else {
			$this->request->redirect($this->request->referrer());
		}
	}
}
