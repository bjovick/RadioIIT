<?php
/**
 * Variables
 * $id => id de cancion
 * $accion => el valor del atributo action en el formulario
 */
$accion = isset($accion) ? $accion : URL::site('/musica/peticion');
?>
<form name="modificar_form" action="<?php echo $accion; ?>" method="POST">
	<input type="hidden" name="id" value="<?php echo $id; ?>" />
	<?php echo Form::image(null,null,array('src'=>'media/img/editar.png',
																				 'alt'=>'Editar')); ?>
</form>

