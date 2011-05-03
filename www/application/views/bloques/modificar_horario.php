<?php
/**
 * Variables:
 * $id => id del horario para cambiar
 * $accion => action atributo del formulario
 */
$accion = isset($accion)? $accion : URL::site('admin/modificar_horario/'.$id);
$h = Model_Horarios::leer($id)->current();
$h['generos'] = explode(',',$h['generos']);
//echo '<pre>'.var_export($h,true).'</pre>'.PHP_EOL;
$generos = array();
$tmp = DB::select('genero')->distinct(true)
	->from('canciones')->execute()->as_array();
foreach($tmp as $r) {
	$generos[] = $r['genero'];
}
unset($tmp);
$intervalos = Horarios::intervalos_de_tiempo();
?>
<form method="POST" action="<?php echo $accion; ?>">
	<p>
		<label>Nombre: </label>
		<input type="text" name="nombre" value="<?php echo $h['nombre']; ?>" />
	</p>
	<p>
		<label>Generos: </label>
		<?php
		foreach($h['generos'] as $gen) {
			echo '<div class="generos"><select name="generos[]">'.PHP_EOL;
			foreach($generos as $g) {
				echo '<option value="'.$g.'"'.(($g == $gen)?' selected':'').'>'.$g.'</option>'.PHP_EOL;
			}
			echo '</select></div>'.PHP_EOL;
		}
		?>
		<small><a href="#generos" class="agregar_set">agregar un genero m&aacute;s</a> |
		<a href="#generos" class="eliminar_set">eliminar un genero</a></small>
	</p>
	<p>
		<label>D&iacute;a: </label>
		<select name="dia">
			<option value="lunes"<?php echo ($h['dia']=='lunes')?'selected':''; ?>>Lunes</option>
			<option value="martes"<?php echo ($h['dia']=='martes')?'selected':''; ?>>Martes<option>
			<option value="miercoles"<?php echo ($h['dia']=='miercoles')?'selected':''; ?>>Miercoles<option>
			<option value="jueves"<?php echo ($h['dia']=='')?'jueves':''; ?>>Jueves<option>
			<option value="viernes"<?php echo ($h['dia']=='')?'viernes':''; ?>>Viernes<option>
			<option value="sabado"<?php echo ($h['dia']=='')?'sabado':''; ?>>Sabado<option>
			<option value="domingo"<?php echo ($h['dia']=='')?'domingo':''; ?>>Domingo<option>
		</select>
	</p>
	<p>
		<label>Tiempo Inicial: </label>
		<select name="tiempo_inicial">
		<?php
		foreach($intervalos as $t) {
			$seg = date('H:i:s', $t);
			echo '<option value="'.$seg.'"'.
				(($seg == $h['tiempo_inicial'])?' selected':'').'>'.$seg.'</option>'.PHP_EOL;
		}
		?>
		</select>
	</p>
	<p>
		<label>Tiempo Final: </label>
		<select name="tiempo_final">
		<?php
		foreach($intervalos as $t) {
			$seg = date('H:i:s', $t);
			echo '<option value="'.$seg.'"'.
				(($seg == $h['tiempo_final'])?' selected':'').'>'.$seg.'</option>'.PHP_EOL;
		}
		?>
		</select>
	</p>
	<input type="hidden" name="id" value="<?php echo $id; ?>" />
	<p>
		<input type="submit" value="Guardar Cambios" />
	</p>
</form>
