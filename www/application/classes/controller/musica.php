<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Musica extends Controller {
	protected $_default_v;

	public function before() {
		$this->_default_v = View::factory('plantilla/default.php');
	}

	public function action_index() {
		$this->response->body('la musica y todo lo importante esta aqui');
	}

}
