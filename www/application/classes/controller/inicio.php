<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Inicio extends Controller {

	public function action_index() {
		$h = Horarios::actual();
		$p = Playlist::instancia();
		$canciones = $p->canciones();
		$canciones[0]['actual'] = true;
		$playlist = array(
			'generos' => $h['generos'],
			'nombre' => $h['nombre'],
			'canciones' => $canciones,
		);


		$anuncio = Markdown(Model_Contenidos::leer('inicio.anuncio')->get('texto_md'));
		$intro = Markdown(Model_Contenidos::leer('inicio.intro')->get('texto_md'));
		$aux = View::factory('bloques/login').PHP_EOL.
			 View::factory('bloques/playlist')
			 ->set('playlist', $playlist)
				->set('con_cancion_actual', true)
			 ->set('titulo', 'Tocando: '.(empty($playlist['nombre'])
																	? $playlist['generos'] : $playlist['nombre']));
	
		$inicio_v = View::factory('paginas/inicio')
								->set('anuncio', $anuncio)
								->set('intro', $intro)
								->set('auxiliar', $aux);
		$default_v = View::factory('plantillas/default')
									->set('contenido', $inicio_v);
		$this->response->body($default_v);
	}

}
