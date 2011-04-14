<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Musica extends Controller {
	protected $_V;

	public function before() {
		$this->_V = View::factory('plantillas/default');
	}

	public function action_index() {
		$desc = Markdown(str_replace('::link-registracion::',URL::site('/cuenta/registrate'),
																	Model_Contenidos::leer('musica.descripcion')->get('texto_md')));

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
					'actual'=>true
				),
				array(
					'id' => 2,
					'titulo' =>'The Beast and the Harlot',
					'artista' => 'Avenged Sevenfold',
					'duracion' => 115
				),
				array(
					'id' => 3,
					'titulo' =>'Don\'t stop believin',
					'artista' => 'Journey',
					'duracion' => 115
				),
			)
		);
		$musica_v = View::factory('paginas/musica')
			->set('descripcion', $desc)
			->set('playlist_actual', $playlist);
		$this->_V->set('contenido', $musica_v);
		$this->response->body($this->_V);
	}

	public function action_peticion() {
		//TODO agregar peticion
		//incrementar el contador de canciones por usuario
		//redireccionar al referidor
		$this->response->body('recivido mi compa');
	}
}
