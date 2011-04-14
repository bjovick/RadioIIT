<?php
/**
 * Variables:
 * $playlist => array conteniendo la infor y canciones del playlist
 * $titulo => texto prefijo del genero en el titulo
 * $con_peticiones => boolean que determina si se pone el boton de agreagr a lista
 * $con_titulo => boolean para ensenar el titulo o no
 */
$titulo = isset($titulo) ? $titulo.' ' : '';
$con_peticiones = isset($con_peticiones) ? $con_peticiones : false;
$con_titulo = isset($con_titulo)
						? $con_titulo
						: empty($titulo)
							? false
							: true;
if (!empty($playlist)
	 && !empty($playlist['genero'])
	 && !empty($playlist['canciones'])) {
	if($con_titulo) {
?>
<h5><?php echo $titulo; ?></h5>
<?php } //con_titulo ?>

<ul class="playlist">
<?php
		 //TODO hacer esto con javascript y ajax
	foreach($playlist['canciones'] as $c) {
		$peticion = '';
		$clase = isset($c['actual'])?' class="cancion_actual"':'';
		echo '<li'.$clase.'>'.$peticion.$c['artista'].' - '.$c['titulo'].'</li>';
	}
?>
</ul>
<?php } ?>
