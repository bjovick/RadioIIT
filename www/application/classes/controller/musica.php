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
		if($this->request->method() == Request::POST) {
			$cancionid = $this->request->post();
			$cancionid = intval($cancionid['cancion_id']);
			$msg = '';
			$p = Playlist::instancia();

			//checar que el usuario no a pasado los limites
			if(Usuario::peticion_es_valida()) {
				//la peticion es valida
				//agregar cancion a la base de datos
				if($p->agregar_peticion($cancionid)) {
					$msg .= 'La peticion fue agregada.';
				}
				else {
					$msg .= 'Hubo un error en la peticion.
										Trata de nuevo. Si el error persiste, contacta al administrador.';
				}
			} else {
				//usuario no pasa validacion
				$msg .= 'Has sobrepasado tu limite de peticiones ('.
					Sitio::config('no._de_peticiones_permitidas_por_usuario').') por '.
					Fecha::duracion_nat(intval(Sitio::config('limite_de_tiempo_para_no._de_peticiones_(segs)'))).'.';
			}

			$p = View::factory('paginas/basica')
				->set('cont_principal', Markdown($msg))
				->set('cont_auxiliar', '');
			$this->response->body($this->_V->set('contenido',$p));

		} else {
			$this->request->redirect($this->request->referrer());
		}
	}
	public function action_recomendar() {
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
				//si existen, a mandar la recomendacion en email
				if(Usuario::recomendacion_es_valida()) {
					$res = mail(Sitio::config('email_para_recibir_recomendaciones'),
											'Recomiendan una cancion desde el sitio RadioIIT',
											'Recomiendan \''.$post['titulo'].'\' de \''.$post['artista'].'\'.',
											'From: '.Sitio::config('email_para_recibir_recomendaciones'));
					$msg = $res
							 ? 'La recomendacion fue enviada.'
							 : 'Hubo un problema al enviar la recomendacion. Trate de nuevo.
									Si el problema persiste contacte al administrador.';
				} else {
					$msg .= 'Has sobrepasado tu limite de recomendaciones ('.
						Sitio::config('no._de_recomendaciones_permitidas_por_usuario').') por '.
						Fecha::duracion_nat(intval(Sitio::config('limite_de_tiempo_para_no._de_recomendaciones_(segs)'))).'.';
			
				}

			}

			$p = View::factory('paginas/basica')
				->set('cont_principal', Markdown($msg))
				->set('cont_auxiliar', '');
			$this->response->body($this->_V->set('contenido', $p));
		} else {
			$this->request->redirect($this->request->referrer());
		}
	}
}
