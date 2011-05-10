<?php
/**
 * Variables:
 * $descripcion => descripcion de la pagina y lo que se puede hacer
 * $playlist_actual => la playlist que se esta tocando ahorita
 * $canciones_dispo => lista (array) de canciones disponibles que el usuario puede pedir
 */
?>
<div id="mainbar">
	<?php
if (Auth::esta_auth()) {
		//ensenar la lista dispoible de canciones
		$desc = Model_Contenidos::leer('peticion.descripcion')->get('texto_md');
		$desc = str_replace('::num_pet::',Sitio::config('no._de_peticiones_permitidas_por_usuario'),$desc);
		$lapso = ((int) Sitio::config('limite_de_tiempo_para_no._de_peticiones_(segs)')) / Date::MINUTE;
		$desc = str_replace('::lapso::',"$lapso",$desc);
		echo Markdown($desc),PHP_EOL,
				 View::factory('bloques/playlist')
					->set('con_peticiones', true)
					->set('con_titulo', false)
					->set('clases', ' resalte_azul')
					->set('playlist', $canciones_dispo),PHP_EOL;
	} else {
		echo Markdown(str_replace('::link-registracion::',URL::site('/cuenta/registrate'),
															Model_Contenidos::leer('musica.descripcion')->get('texto_md')));
	}
	?>
</div>
<div id="sidebar">
	<?php
	echo View::factory('bloques/login'),PHP_EOL,
			 View::factory('bloques/playlist')
			 ->set('playlist', $playlist_actual)
				->set('con_cancion_actual', true)
			 ->set('titulo', 'Tocando: '.(empty($playlist_actual['nombre'])
																	? $playlist_actual['generos'] : $playlist_actual['nombre']));
	echo View::factory('bloques/playlist')
		->set('titulo', 'Top Diez')
		->set('playlist', array('canciones' => Canciones::mas_pedidas()));
	if(Auth::esta_auth()) {
		//ensenar el formulario de recomendacion
		echo Markdown(Model_Contenidos::leer('recomendaciones.desc')
			->get('texto_md')),PHP_EOL,
				View::factory('bloques/recomendar_form');
	}	
	?>
</div>
