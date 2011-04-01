<?php require_once 'sistema/config.php' ?>
<!DOCTYPE html>
<html lang="es-mx">
<head>
	<title>Programacion Musical | RadioIIT - Ingenium Rado</title>
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
			$v = new Vista('blocks/login')->set('nombre','marco');
			echo $v->presentar();
			?>
		</div>
		<br class="clear" />
	</div>
	<footer>
		<p>&copy; Copyright 2011 RadioIIT</p>
	</footer>
</body>
</html>

