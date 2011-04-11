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
}
