<?php
/**
 * Variables
 * $accion => el valor del atributo action en el formulario
 */
$accion = isset($accion) ? $accion : URL::site('/cuenta/cambiar_contrasena');
?>
<form name="cambiar_contrasena" action="<?php echo $accion; ?>" method="POST">
	<p>
		<label>Nueva contrase&ntilde;a:</label>
		<input type="password" name="nueva_contrasena" />
	</p>
	<p>
		<label>Repita la nueva contrase&ntilde;a:</label>
		<input type="password" name="nueva_contrasena_repetida" />
	</p>
	<p>
		<input type="submit" name="cambiar" value="Cambiar" />
	<p>
</form>

