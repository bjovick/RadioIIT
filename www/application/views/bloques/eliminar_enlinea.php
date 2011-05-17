<?php
/**
 * Variables
 * $id => id de cancion
 * $accion => el valor del atributo action en el formulario
 */
?>
<form name="eliminar_form" action="<?php echo $accion; ?>" method="POST">
	<input type="hidden" name="id" value="<?php echo $id; ?>" />
	<?php echo Form::image(null,null,array('src'=>'media/img/basura.png',
																				 'alt'=>'Eliminar',
																				 'class'=>'asegurarse')); ?>
</form>

