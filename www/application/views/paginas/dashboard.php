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
		<h4><a class="alternar" href="#horarios">Horarios</a></h4>
		<section id="horarios">
			<ul class="menu_linear">
				<li><a href="<?php echo URL::site('/admin/agregar_horario'); ?>">Agregar Horario</a></li>
			</ul>

			<ul>
				<?php
				$horarios = Model_Horarios::navegar()->as_array();
				$mod_form = View::factory('bloques/modificar_enlinea')
					->set('accion', URL::site('admin/modificar_horario'));
				$eli_form = View::factory('bloques/eliminar_enlinea')
					->set('accion', URL::site('admin/eliminar_horario'));
				if (!empty($horarios)) {
					echo '<li><strong>Nombre &mdash; G&eacute;neros &mdash; el D&iacute;a de Tiempo Inicial a Tiempo Final</strong></li>'.PHP_EOL;
					foreach($horarios as $h){
						$mod_form->set('id', $h['id']);
						$eli_form->set('id', $h['id']);
						echo '<li>'.$mod_form.' '.$eli_form.' '.
									(empty($h['nombre'])?'<em>Sin nombre</em>':$h['nombre']).
									' &mdash; '.implode(', ', explode(',', $h['generos'])).
									' &mdash; el '.ucwords($h['dia']).
									' de <samp>'.$h['tiempo_inicial'].'</samp>'.
									' a <samp>'.$h['tiempo_final'].'</samp></li>'.PHP_EOL;
					}	
				}
				else {
					echo '<li>No hay horarios</li>';
				}
				?>
			</ul>
		</section>
	</li>
		<li>
		<h4><a class="alternar" href="#usuarios">Usuarios</a></h4>
		<section id="usuarios">
			<ul class="menu_linear">
				<li><a href="<?php echo URL::site('/admin/agregar_usuario'); ?>">Agregar Usuario</a></li>
			</ul>
			<ul>
				<?php
				//TODO: mostrar lista de todos las usuarios 
				$usuarios = Model_Usuarios::navegar()->as_array();
				if (!empty($usuarios)) {
					$mod_form = View::factory('bloques/modificar_enlinea')
						->set('accion', URL::site('admin/modificar_usuario'));
					$eli_form = View::factory('bloques/eliminar_enlinea')
						->set('accion', URL::site('admin/eliminar_usuario'));
				
					echo '<li><strong>Usuario &mdash; Rol</strong></li>'.PHP_EOL;
					foreach($usuarios as $usuario){
						$mod_form->set('id', $usuario['id']);
						$eli_form->set('id', $usuario['id']);
						
						echo '<li>'.$mod_form.' '.$eli_form.' '.$usuario['usuario'].' &mdash; '.$usuario['rol'].'</li>';
					}	
				}
				else {
					echo '<li>No hay usuarios</li>';
				}
				?>
			</ul>
		</section>
	</li>
	<li>
		<h4><a class="alternar" href="#configuracion">Configuraci&oacute;n</a></h4>
		<section id="configuracion">
			<?php
			echo View::factory('bloques/config_sitio_form');
			?>
		</section>
	</li>
		
<?php } ?>
	<li>
		<h4><a class="alternar" href="#cambiar_contrasena">Cambiar Contrase&ntilde;a</a></h6>
		<section id="cambiar_contrasena">
			<?php echo View::factory('bloques/cambiar_contrasena'); ?>
		</section>
	</li>
	<li>
		<h4><?php echo HTML::anchor(
			URL::site('/cuenta/eliminar'),
			'Eliminar mi cuenta',
			array(
				'class'=>'asegurarse',
				'rel'=>'Estas seguro de eliminar tu cuenta permanentemente?',
			)); ?></h4>
	</li>
</li>
