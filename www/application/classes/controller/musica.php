<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Musica extends Controller {

	public function action_index()
	{
		$this->response->body('la musica y todo lo importante esta aqui');
	}

}
