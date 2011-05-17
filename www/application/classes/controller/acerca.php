<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Acerca extends Controller {

	public function action_index() {
		$desc = Markdown(Model_Contenidos::leer('acerca.descripcion')->get('texto_md'));
		$login = View::factory('bloques/login');
		$pagina = View::factory('paginas/basica')
							->set('cont_principal', $desc)
							->set('cont_auxiliar', $login);


		$_V = View::factory('plantillas/default')
					->set('contenido', $pagina);

		$this->response->body($_V);
	}

}
