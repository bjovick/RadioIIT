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
	echo $descripcion;
	if (Auth::esta_auth()) {
		//ensenar la lista dispoible de canciones
		echo View::factory('bloques/playlist')
					->set('con_peticiones', true)
					->set('con_titulo', false)
					->set('playlist', $lista),
				 View::factory('bloques/recomendar_form');
	}
	?>
</div>
<div id="sidebar">
	<?php
	echo View::factory('bloques/login'),
			 View::factory('bloques/playlist')
			 ->set('playlist', $playlist_actual)
			 ->set('titulo', 'Tocando: '.(empty($playlist_actual['nombre'])
																	? $playlist_actual['genero'] : $playlist_actual['nombre']));
	?>
</div>
