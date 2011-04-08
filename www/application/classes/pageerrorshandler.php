<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Handles HTTP errors and the like, which are not catched
 * by the application
 */
class PageErrorsHandler {
	private $_default_v;
	private $_error_v;
	public $response;

	public function __construct() {
		$this->_default_v = View::factory('templates/default')
												->set('pagename', 'error')
												->set('title', 'Problem | Mandi and Tony\'s Wedding Website');

		$this->_error_v = View::factory('errors/default');
		$this->response = new Response();
	}

	public function handle(Exception $e) {
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
		$err = DB::select('*')
						->from('error_pages')
						->where('code','=',404)
						->where('lang','=',App::lang())
						->execute();
		$this->_error_v->set('code',404)
										->set('status',$err->get('status'))
										->set('title',$err->get('title'))
										->set('content',$err->get('content'));

		$this->_default_v->set('content', $this->_error_v);

		$this->response->status(404);
		return $this->response->body($this->_default_v);
	}

	public function action_500() {
		$err = DB::select('*')
						->from('error_pages')
						->where('code','=',500)
						->where('lang','=',App::lang())
						->execute();
		$this->_error_v->set('code',500)
										->set('status',$err->get('status'))
										->set('title',$err->get('title'))
										->set('content',$err->get('content'));

		$this->_default_v->set('content', $this->_error_v);

		$this->response->status(500);
		return $this->response->body($this->_default_v);
	}
}
