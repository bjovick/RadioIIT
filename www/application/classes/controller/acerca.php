<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Acerca extends Controller {

	public function action_index()
	{
		$this->response->body('quienes somos');
	}

}
