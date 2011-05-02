<?php
/**
 * Variables:
 * $playlist => array conteniendo la infor y canciones del playlist
 * $titulo => texto prefijo del genero en el titulo
 * $con_peticiones => boolean que determina si se pone el boton de agreagr a lista
 * $con_cancion_actual => boolean que dice si dan enfaciz a la cancion actual
 * $con_titulo => boolean para ensenar el titulo o no
 * $clases => clases extra que ponerle al ul
 */
$titulo = isset($titulo) ? $titulo.' ' : '';
$con_peticiones = isset($con_peticiones) ? $con_peticiones : false;
$con_cancion_actual = isset($con_cancion_actual) ? $con_cancion_actual : false;
$con_titulo = isset($con_titulo)
						? $con_titulo
						: empty($titulo)
							? false
							: true;
$clases = isset($clases) ? $clases : '';

//Kohana::$log->add(Log::DEBUG, 'adentro de view/bloques/playlist');

if (!empty($playlist)
	 && !empty($playlist['canciones'])) {
	//echo '<pre>'.var_export($playlist['canciones'],true).'</pre>';
	if($con_titulo) {
?>
<h5><?php echo $titulo; ?></h5>
<?php } //con_titulo ?>

<ul class="playlist<?php echo $clases;?>">
<?php
	//Kohana::$log->add(Log::DEBUG, 'ensenando playlist, size '.count($playlist['canciones']));
	
	//TODO hacer esto con javascript y ajax
	foreach($playlist['canciones'] as $c) {
		$peticion = ($con_peticiones)
							? View::factory('bloques/pedir_enlinea')->set('id', $c['id'])
							: '';
		$clase = (isset($c['actual']) && $con_cancion_actual)
							? ' class="cancion_actual"'
							: '';
		echo '<li'.$clase.'>'.$peticion.$c['artista'].' - '.$c['titulo'].'</li>';
	}
?>
</ul>
<?php } ?>
