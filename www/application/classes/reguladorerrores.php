<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Handles HTTP errors and the like, which are not catched
 * by the application
 */
class ReguladorErrores {
	private $_V;
	public $response;

	public function __construct() {
		$this->_V = View::factory('plantillas/default')
			->set('pagina', 'error');

		$this->response = new Response();
	}

	public function gestionar(Exception $e) {
		Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e));
		switch (get_class($e)) {
			case 'Http_Exception_404':
				echo $this->action_404()->send_headers()->body();
				return true;
				break;
			default:
				if(Kohana::$environment == Kohana::PRODUCTION) {
					echo $this->action_500()->send_headers()->body();
					return true;
				} else {
					return Kohana_Exception::handler($e);
				}
				break;
		}
	}

	public function action_404() {
		$error = '###Error 404 No Encontrado###'."\n\n".
						 'No se pudo encontrar lo que estabas buscando.'.

		$this->_V->set('contenido', Markdown($error));

		$this->response->status(404);
		return $this->response->body($this->_V);
	}

	public function action_500() {
		$error = '###Error 500 Error Interno###'."\n\n".
						 'Tenemos problemas tecnicos. Por favor intente mas tarde.'.

		$this->_V->set('contenido', Markdown($error));

		$this->response->status(500);
		return $this->response->body($this->_V);
	}
}
