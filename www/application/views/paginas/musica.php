<?php
/**
 * Variables:
 * $descripcion => descripcion de la pagina y lo que se puede hacer
 * $playlist_actual => la playlist que se esta tocando ahorita
 */
?>
<div id="mainbar">
	<?php
	echo $descripcion,
			 View::factory('bloques/recomendar_form'),
			 View::factory('bloques/peticiones_form');
	?>
</div>
<div id="sidebar">
	<?php
	echo View::factory('bloques/login'),
			 View::factory('bloques/playlist')
			 ->set('actual', $playlist_actual);
	?>
</div>
