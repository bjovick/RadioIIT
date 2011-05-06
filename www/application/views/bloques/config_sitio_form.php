<form method="POST" action="<?php echo URL::site('admin/modificar_sitio_configs'); ?>">
	<?php
	$configs = Sitio::configs();
	
	foreach($configs as $c) {
	?>
	<p>
		<label><?php echo ucwords(trim(str_replace('_',' ',$c['llave']))); ?>:</label>
		<?php
		if($c['tipo']=='boolean') { //significa que es un booleano entonces usamos dropdown
		?>	
		<select name="<?php echo $c['llave']; ?>">
			<option value="true" <?php echo ($c['valor'] == 'true')?'selected':'';?>>Si</option>
			<option value="false" <?php echo ($c['valor'] == 'false')?'selected':'';?>>No</option>
		</select>
		<?php
		}
		else {
		?>
		<input type="text" name="<?php echo $c['llave']; ?>" value="<?php echo $c['valor']; ?>" />
		<?php } 
		if($c['llave'] == 'cantidad_de_items_por_lista') {
			//un comentario
		?>
		<small>Con valor 0 no hay limite</small>
		<?php
		}
		?>
	</p>
	<?php } ?>
	<p>
		<input type="submit" value="Guardar Cambios" />
	</p>
</form>
