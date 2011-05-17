<?php
/**
 * Variables:
 * $accion => action atributo del formulario
 */
$accion = isset($accion)? $accion : URL::site('admin/agregar_horario');

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
		<input type="text" name="nombre" value="" />
	</p>
	<p>
		<label>Generos: </label>
		<div class="generos">
			<select name="generos[]">
			<?php
				foreach($generos as $g) {
					echo '<option value="'.$g.'">'.$g.'</option>'.PHP_EOL;
				}
			?>
			</select>
		</div>
		<small><a href="#generos" class="agregar_set">agregar un g&eacute;nero m&aacute;s</a> |
		<a href="#generos" class="eliminar_set">eliminar un g&eacute;nero</a></small>
	</p>
	<p>
		<label>D&iacute;a: </label>
		<select name="dia">
			<option value=""></option>
			<option value="lunes">Lunes</option>
			<option value="martes">Martes</option>
			<option value="miercoles">Miercoles</option>
			<option value="jueves">Jueves</option>
			<option value="viernes">Viernes</option>
			<option value="sabado">Sabado</option>
			<option value="domingo">Domingo</option>
		</select>
	</p>
	<p>
		<label>Tiempo Inicial: </label>
		<select name="tiempo_inicial">
		<?php
		foreach($intervalos as $t) {
			echo '<option value="'.date('H:i:s', $t).'">'.date('h:ia',$t).'</option>'.PHP_EOL;
		}
		?>
		</select>
	</p>
	<p>
		<label>Tiempo Final: </label>
		<select name="tiempo_final">
		<?php
		foreach($intervalos as $t) {
			echo '<option value="'.date('H:i:s', $t).'">'.date('h:ia',$t).'</option>'.PHP_EOL;
		}
		?>
		</select>
	</p>
	<p>
		<input type="submit" value="Guardar Cambios" />
		<?php echo HTML::anchor(URL::site('/cuenta#horarios'), 'Cancelar'); ?>
	</p>
</form>
