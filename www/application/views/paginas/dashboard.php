<?php
/**
 * Variables
 * $es_admin => boolean que dice si es admin o no;
 */
//defaults
$u = Auth::usuario();
$es_admin = isset($es_admin) ? $es_admin : false;
?>
<ul id="dashboard">
<?php if($es_admin) { ?>
	<li>
		<h4>Horarios</h4>
		<section>
			<ul class="menu_linear">
				<li><a href="">Agregar Horario</a></li>
			</ul>

			<ul>
				<?php
				//TODO: mostrar lista de todos los horarios 
				$horarios = Model_Horarios::navegar()->as_array();
				if (!empty($horarios)) {
					foreach($horarios as $h){
					}	
				}
				else {
					echo '<li>No hay horarios</li';
				}
				?>
			</ul>
		</section>
	</li>
	<li>
		<h4>Recomendaciones</h4>
		<section>
			<ul>
				<?php
				//TODO: mostrar lista de todas las recomendaciones 
				if (!empty($recoms)) {
					foreach($recoms as $r){
					}	
				}
				else {
					echo '<li>No hay recomendaciones</li';
				}
				?>
			</ul>
		</section>
	</li>
	<li>
		<h4>Usuarios</h4>
		<section>
			<ul class="menu_linear">
				<li><a href="">Agregar Usuario</a></li>
			</ul>
			<ul>
				<?php
				//TODO: mostrar lista de todos las usuarios 
				if (!empty($usuario)) {
					foreach($usuario as $usuario){
					}	
				}
				else {
					echo '<li>No hay recomendaciones</li';
				}
				?>
			</ul>
		</section>
	</li>
<?php } ?>
	<li>
		<h4>Configuracion</h4>
		<section>
			<ul>
				<li><?php echo HTML::anchor('/cuenta/cambiar-contrasena', 'Cambiar Contrase&ntilde;a'); ?>.</li>
				<li><?php echo HTML::anchor('/cuenta/eliminar', 'Eliminar mi cuenta'); ?>.</li>
				<?php if($es_admin) { ?>
				<li><?php echo HTML::anchor('/musica/sync-librerias', 'Actualizar librerias'); ?>.</li>
				<?php } ?>
			</ul>
		</section>
	</li>
</li>
