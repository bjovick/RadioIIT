<?php
/**
 * Variables
 * $id => id de cancion
 * $accion => el valor del atributo action en el formulario
 */
$accion = isset($accion) ? $accion : URL::site('/musica/peticion');
?>
<form name="peticion_form" action="<?php echo $action; ?>" method="POST">
	<input type="hidden" name="cancion_id" value="<?php echo $id; ?>" />
	<?php echo Form::image(null,null,array('src'=>'/media/img/agregar/png',
																				 'alt'=>'pedir cancion')); ?>
</form>

