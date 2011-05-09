<?php
/**
 * Variables:
 * $esta_auth => true o false esta autenticado
 * $es_admin => true o false si es admin
 * $titulo => titulo de la pagina
 * $cont_principal => contenido en la columna principal
 * $cont_auxiliar => contenido en la columna auxiliar
 * $estilos => arreglo con los paths de los estilos
 * $scripts => arreglo con los paths de los scripts
 * $usarjquery => si se agrega jquery a la pagina
 * $pagina => id del la etiqueta body definiendo la pagina (usado para css)
 */
// senales //
$es_admin = isset($es_admin) ? $es_admin : false;
$esta_auth = isset($esta_auth)
						? $esta_auth
						: ($es_admin
							? true
							: false);
// contenidos //
$titulo = isset($titulo) ? $titulo : 'Programacion Musical | RadioIIT - Ingenium Radio';
$contenido = isset($contenido) ? $contenido : '';
// estilos y scripts
$estilos = isset($estilos) ? $estilos : array();
$scripts = isset($scripts) ? $scripts : array();
$usarjquery = isset($usarjquery) ? true : false;
$pagina = isset($pagina) ? $pagina : Request::current()->controller();
?>
<!DOCTYPE html>
<html lang="es-mx" id="<?php echo 'pagina_',$pagina; ?>">
<head>
	<title><?php echo $titulo ?></title>
	<link rel="shortcut icon" href="/media/img/favicon.ico" />
	<?php
	echo HTML::style('media/css/estilo.css', array('rel' => 'stylesheet'));

	foreach($estilos as $archivo) {
		echo HTML::style($archivo,array('rel', 'stylesheet')),PHP_EOL;
	}
	?>
</head>
<body>
	<header>
		<nav>
			<ul>
			<li><a href="<?php echo URL::base();?>"<?php echo ($pagina=='inicio')?' class="actual"':'';?>>Inicio</a></li>
				<li><a href="<?php echo URL::site('acerca');?>"<?php echo ($pagina=='acerca')?' class="actual"':'';?>>Qui&eacute;nes Somos</a></li>
				<li><a href="<?php echo URL::site('musica');?>"<?php echo ($pagina=='musica')?' class="actual"':'';?>>M&uacute;sica</a></li>
				<li><a href="<?php echo URL::site('cuenta');?>"<?php echo ($pagina=='cuenta')?' class="actual"':'';?>>Tu Cuenta</a></li>
			</ul>
		</nav>
		<h1><em>Radio</em>IIT<small>ingenium radio</small></h1>
		<ul id="social_links">
			<li>
				<a href="http://facebook.com/radioiit" target="_blank" alt="Siguenos en facebook" >
					<img src="/media/img/facebook-icon.png"/></a></li>
			<li>
				<a href="http://twitter.com/radioiit" target="_blank" alt="Siguenos en twitter" >
					<img src="/media/img/twitter_icons_256.png"/></a></li>
			<li>
				<a href="http://myspace.com/iitradio" target="_blank" alt="Siguenos en myspace" >
					<img src="/media/img/myspace_icon.png"/></a></li>
		</ul>
	</header>
	<div id="main">
		<?php echo $contenido; ?>
		<br class="clear" />
	</div>
	<footer>
		<p>&copy; Copyright 2011 RadioIIT</p>
	</footer>

	<!-- JAVASCRIPT -->
	<?php
	if($usarjquery) {
	?>
		<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>-->
		<script src="/media/js/jquery-1.5.min.js"></script>
	<?php
	}
	foreach($scripts as $archivo) {
		echo HTML::script($archivo, NULL, TRUE),PHP_EOL;
	}
	?>
</body>
</html>

