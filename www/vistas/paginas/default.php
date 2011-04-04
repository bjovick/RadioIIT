<?php
/**
 * Variables:
 * $titulo => titulo de la pagina
 * $esta_auth => true o false esta autenticado
 * $es_admin => true o false si es admin
 * $cont_principal => contenido en la columna principal
 * $cont_auxiliar => contenido en la columna auxiliar
 */
$titulo = isset($titulo) ? $titulo : 'Programacion Musical | RadioIIT - Ingenium Radio';
$es_admin = isset($es_admin) ? $es_admin : false;
$esta_auth = isset($esta_auth)
						? $esta_auth
						: ($es_admin
							? true
							: false);
$cont_principal = isset($cont_principal) ? $cont_principal : '';
$cont_auxiliar = isset($cont_auxiliar) ? $cont_auxiliar : '';
?>
<!DOCTYPE html>
<html lang="es-mx">
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>
<body>
	<header>
		<nav>
			<ul>
				<li><a href="">Inicio</a></li>
				<li><a href="">Quienes Somos</a></li>
				<li><a href="">prueba</a></li>
				<li><a href="">1 2 3</a></li>
			</ul>
		</nav>
		<h1><em>Radio</em>IIT<small>ingenium radio</small></h1>
		<ul id="social_links">
			<li>
				<a href="http://facebook.com/radioiit" target="_blank" alt="Siguenos en facebook" >
					<img src="/assets/imagenes/facebook-icon.png"/></a></li>
			<li>
				<a href="http://twitter.com/radioiit" target="_blank" alt="Siguenos en twitter" >
					<img src="/assets/imagenes/twitter_icons_256.png"/></a></li>
			<li>
				<a href="http://myspace.com/iitradio" target="_blank" alt="Siguenos en myspace" >
					<img src="/assets/imagenes/myspace_icon.png"/></a></li>
		</ul>
	</header>
	<div id="main">
		<div id="mainbar">
			tirando weba
		</div>
		<div id="sidebar">
			<?php
			//$v = View::factory('blocks/login');
			$v = Vista::crear('blocks/login', array('n'=>'tonyl'));
			echo $v;
			?>
		</div>
		<br class="clear" />
	</div>
	<footer>
		<p>&copy; Copyright 2011 RadioIIT</p>
	</footer>
</body>
</html>

