<?php
/**
 * Variables:
 * $id => id del usuario para cambiar
 * $accion => action atributo del formulario
 * $modificar => booleano que dice si el formulario se usara para modificar o no
 */
$accion = isset($accion)? $accion : URL::site('admin/modificar_usuario/'.$id);
$modificar = isset($modificar) ? $modificar : true;
$id = ($modificar == true) ? $id : '';
$usuario = ($modificar == true) ? Model_Usuarios::leer($id)->current() : null;
?>
<form method="POST" action="<?php echo $accion; ?>">
	<p>
		<label>Usuario: </label>
		<input type="text" name="usuario" value="<?php echo ($modificar) ? $usuario['usuario'] : ''; ?>" />
	</p>
	<p>
		<label>Nueva Contrase&ntilde;a: </label>
		<input type="password" name="nueva_contrasena" value="" />
		<small>6 caracteres o m&aacute;s</small>
	</p>
	<?php if($modificar) { ?>
	<p>
		<label>Repetir Nueva Contrase&ntilde;a: </label>
		<input type="password" name="nueva_contrasena_repetida" value="" />
		<small>6 caracteres o m&aacute;s</small>
	</p>
	<input type="hidden" name="id" value="<?php echo $id; ?>" />
	<?php } ?>
	<p>
		<label>Rol: </label>
		<select name="rol">
			<option value="admin" <?php echo ($usuario['rol'] == 'admin' && $modificar)?'selected':'';?>>admin</option>
			<option value="normal"
				<?php echo (($usuario['rol'] == 'normal' && $modificar) || !$modificar)?'selected':'';?>>normal<option>
		</select>
	</p>
	<p>
		<input type="submit" value="Guardar Cambios" />
	</p>
</form>
