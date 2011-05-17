<form method="POST" action="<?php echo URL::site('admin/modificar_sitio_configs'); ?>">
	<?php
	$configs = Sitio::configs();
	
	foreach($configs as $c) {
		if($c['configurable'] == 'false') {
			continue;
		}
	?>
	<p>
		<label><?php echo ucfirst(trim(str_replace('_',' ',$c['llave']))); ?>:</label>
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
		if($c['llave'] == 'no._de_canciones_a_mostrar_en_las_listas') {
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
