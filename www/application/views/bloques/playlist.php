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

if (!empty($playlist)
	 && !empty($playlist['canciones'])) {
	if($con_titulo) {
?>
<h5><?php echo $titulo; ?></h5>
<?php } //con_titulo ?>

<ul class="playlist<?php echo $clases;?>">
<?php
	
		//TODO hacer esto con javascript y ajax
	foreach($playlist['canciones'] as $c) {
		if (!empty($c['id'])
			 && !empty($c['artista'])
			 && !empty($c['titulo'])) {
			$peticion = ($con_peticiones)
								? View::factory('bloques/pedir_enlinea')->set('id', $c['id'])
								: '';
			$clase = (isset($c['actual']) && $con_cancion_actual)
								? ' class="cancion_actual"'
								: '';
			echo '<li'.$clase.'>'.$peticion.$c['artista'].' - '.$c['titulo'].'</li>';
		}
	}
?>
</ul>
<?php } ?>
