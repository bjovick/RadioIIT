<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Inicio extends Controller {

	public function action_index() {
		$inicio_v = View::factory('paginas/inicio');
		$default_v = View::factory('plantillas/default')
									->set('contenido', $inicio_v);
		$this->response->body($default_v);
	}

}
