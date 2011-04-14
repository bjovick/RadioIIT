<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Musica extends Controller {
	protected $_V;

	public function before() {
		$this->_V = View::factory('plantillas/default');
	}

	public function action_index() {
		$playlist = array(
			'nombre'=>'',
			'genero'=>'Rock',
			'horario_id'=>1,
			'canciones'=>array(
				array(
					'id' => 1,
					'titulo' =>'It\'s so easy',
					'artista'=>'Guns \'N Roses',
					'duracion' => 123,
					'actual' => true,
					'orden' => 1,
				),
				array(
					'id' => 2,
					'titulo' =>'The Beast and the Harlot',
					'artista' => 'Avenged Sevenfold',
					'duracion' => 115,
					'orden' => 2,
				),
				array(
					'id' => 3,
					'titulo' =>'Don\'t stop believin',
					'artista' => 'Journey',
					'duracion' => 135,
					'orden' => 3,
				),
			)
		);

		$musica_v = View::factory('paginas/musica')
			->set('canciones_dispo', $playlist)
			->set('playlist_actual', $playlist);

		$this->_V->set('contenido', $musica_v);
		$this->response->body($this->_V);
	}

	public function action_peticion() {
		//TODO agregar peticion
		//incrementar el contador de canciones por usuario
		//redireccionar al referidor
		$this->response->body('recivido mi compa. <pre>'.var_export($this->request->post(), true).'</pre>');
		
		if($this->request->method() == Request::POST) {
		} else {
		}
	}
	public function action_recomendar() {
		$this->response->body('recomendado. <pre>'.var_export($this->request->post(), true).'</pre>');
		
		if($this->request->method() == Request::POST) {
		} else {
		}
	}
}
