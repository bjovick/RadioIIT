<form method="POST" action="<?php echo URL::site('admin/modificar_sitio_configs'); ?>">
	<?php
	$configs = Sitio::configs();
	
	foreach($configs as $c) {
	?>
	<p>
		<label><?php echo ucwords(str_replace('_',' ',$c['llave'])); ?>:</label>
		<input type="text" value="<?php echo $c['valor']; ?>" />
	</p>
	<?php } ?>
	<p>
		<input type="submit" value="Guardar Cambios" />
	</p>
</form>
