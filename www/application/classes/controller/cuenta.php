<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Cuenta extends Controller {

	public function action_index()
	{
		$this->response->body('la cuenta y lo admin aqui');
	}

}
