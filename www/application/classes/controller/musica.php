<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Musica extends Controller {
	protected $_V;

	public function before() {
		$this->_V = View::factory('plantillas/default');
	}

	public function action_index() {
		$h = Horarios::actual();
		$p = Playlist::instancia();
		$canciones = $p->canciones();
		$canciones[0]['actual'] = true;
		$disponibles = $playlist = array(
			'generos' => $h['generos'],
			'nombre' => $h['nombre'],
			'canciones' => $canciones,
		);
		$disponibles['canciones'] = $p->disponibles();

		$musica_v = View::factory('paginas/musica')
			->set('canciones_dispo', $disponibles)
			->set('playlist_actual', $playlist);

		$this->_V->set('contenido', $musica_v);
		$this->response->body($this->_V);
	}

	public function action_peticion() {
		//TODO agregar peticion
		//$this->response->body('recivido mi compa. <pre>'.var_export($this->request->post(), true).'</pre>');
		
		if($this->request->method() == Request::POST) {
			$cancionid = $this->request->post();
			$cancionid = intval($cancionid['cancion_id']);
			$msg = '';

			//checar que el usuario no a pasado los limites
			if(Usuario::peticion_es_valida()) {
				//la peticion es valida
				//agregar cancion a la base de datos
				if(Playlist::agregar_peticion($cancionid)) {
					$msg .= 'peticion fue agregada.';
				}
			} else {
				//usuario no pasa validacion
				$msg .= 'muchas peticiones en el lapso permitido';
			}

		} else {
		}
	}
	public function action_recomendar() {
		//TODO
		//$this->response->body('recomendado. <pre>'.var_export($this->request->post(), true).'</pre>');
		
		if($this->request->method() == Request::POST) {
			$post = $this->request->post();
			$titulo = filter_var($post['titulo'], FILTER_SANITIZE_STRING);
			$artista = filter_var($post['artista'], FILTER_SANITIZE_STRING);
			$msg = '';

			if(empty($titulo) || empty($artista)) {
				//no se envio nada, a decirle al usuario
				$msg = 'El titulo o/y el artista estan vacios.
					Se necesitan los dos para mandar una recomendacion.';
			} else {
				//si existen, a mandar la recomendacion
				$res = Model_Recomendaciones::agregar(array(
					'titulo' => $titulo,
					'artista' => $artista,
				));

				$msg = $res
						 ? 'La recomendacion fue enviada.'
						 : 'Hubo un problema al enviar la recomendacion. Trate de nuevo.
								Si el problema persiste contacte al administrador.';
			}

			$p = View::factory('paginas/basica')
				->set('cont_principal', Markdown($msg))
				->set('cont_auxiliar', '');
			$this->response->body($this->_V->set('content', $p));
		} else {
			$this->request->redirect($this->request->referrer());
		}
	}
}
