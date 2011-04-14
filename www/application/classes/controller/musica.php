<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Musica extends Controller {
	protected $_V;

	public function before() {
		$this->_V = View::factory('plantillas/default');
	}

	public function action_index() {
		/*
		$desc = str_replace('::link-registrate::',URL::site('/cuenta/registrate'),
												Modelo_Contenidos::leer('musica.descripcion')->get('texto_md'));
		$playlist = array(
			'genero'=>'',
			'horario_id'=>0,
			'canciones'=>array()
		);
		$musica_v = View::factory('paginas/musica')
			->set('descripcion', $desc)
			->set('playlist_actual' $playlist);
		 */
		$this->_V->set('contenido', 'la musica y todo lo importante esta aqui');
		$this->response->body($this->_V);
	}

}
