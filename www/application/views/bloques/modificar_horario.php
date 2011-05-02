<?php
/**
 * Variables:
 * $id => id del horario para cambiar
 * $accion => action atributo del formulario
 */
$accion = isset($accion)? $accion : URL::site('admin/modificar_horario/'.$id);
$h = Model_Horarios::leer($id)->curret();
$h['generos'] = explode(',',$h['generos']);
$generos = array();
$tmp = DB::select('genero')->distinct()
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
			echo '<p><select name="generos[]">'.PHP_EOL;
			foreach($generos as $g) {
				echo '<option value="'.$g.'"'.(($g == $gen)?' selected':'').'>'.$g.'</option>'.PHP_EOL;
			}
			echo '</select>'.
					 '<input type="checkbox" name="generos_a_borrar[]" value="'.$gen.'" /> borrar?</p>';
		}
		?>
	</p>
	<p>
		<label>D&iacute;a: </label>
		<select name="dia">
			<option value="lunes">Lunes</option>
			<option value="martes">Martes<option>
			<option value="miercoles">Miercoles<option>
			<option value="jueves">Jueves<option>
			<option value="viernes">Viernes<option>
			<option value="sabado">Sabado<option>
			<option value="domingo">Domingo<option>
		</select>
	</p>
	<p>
		<label>Tiempo Inicial: </label>
		<select name="tiempo_inicial">
		<?php
		foreach($intervalos as $t) {
			$seg = date('H:i:s', $t);
			echo '<option value="'.$seg'"'.
				(($seg == $h['tiempo_inicial'])?' selected':'').'>'.$seg.'</option>'.PHP_EOL;
		?>
		</select>
	</p>
	<p>
		<label>Tiempo Final: </label>
		<select name="tiempo_final">
		<?php
		foreach($intervalos as $t) {
			$seg = date('H:i:s', $t);
			echo '<option value="'.$seg'"'.
				(($seg == $h['tiempo_final'])?' selected':'').'>'.$seg.'</option>'.PHP_EOL;
		?>
		</select>
	</p>
	<p>
		<input type="submit" value="Guardar Cambios" />
	</p>
</form>
