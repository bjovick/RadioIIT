<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Inicio extends Controller {

	public function action_index() {
		$anuncio = Markdown(Model_Contenidos::leer('inicio.anuncio')->get('texto_md'));
		$intro = Markdown(Model_Contenidos::leer('inicio.intro')->get('texto_md'));
		$aux = (Auth::esta_auth())
					? Markdown(Model_contenidos::leer('inicio.identificado')->get('texto_md'))
					: View::factory('bloques/login');
		$inicio_v = View::factory('paginas/inicio')
								->set('anuncio', $anuncio)
								->set('intro', $intro)
								->set('auxiliar', $aux);
		$default_v = View::factory('plantillas/default')
									->set('contenido', $inicio_v);
		$this->response->body($default_v);
	}

}
