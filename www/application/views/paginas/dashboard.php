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
		<h4><a href="#horarios">Horarios</a></h4>
		<section id="horarios">
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
		<h4><a href="#recomendaciones">Recomendaciones</a></h4>
		<section id="recomendaciones">
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
		<h4><a href="#usuarios">Usuarios</a></h4>
		<section id="usuarios">
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
		<h4><a class="alternar" href="#configuracion">Configuracion</a></h4>
		<section id="configuracion">
			<ul>
				<li>
					<h6><a class="alternar" href="#cambiar_contrasena">Cambiar Contrase&ntilde;a</a></h6>
					<section id="cambiar_contrasena">
						<?php echo View::factory('bloques/cambiar_contrasena'); ?>
					</section>
				</li>
				<li><h6><?php echo HTML::anchor(
					URL::site('/cuenta/eliminar'),
					'Eliminar mi cuenta',
					array(
						'class'=>'asegurarse',
					)); ?></h6></li>
			</ul>
		</section>
	</li>
</li>
