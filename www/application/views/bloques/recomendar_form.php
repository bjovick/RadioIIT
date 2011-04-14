<?php
/**
 * Variables:
 * $accion => valor del atributo accion del formulario
 */
$accion = isset($accion) ? $accion : URL::site('/musica/recomendar');
?>
<form method="POST" name="recomendar_form" action="<?php echo $accion;?>">
<?php
echo '<p>',Form::label('titulo','Titulo:'),'<br />',
		 Form::input('usuario',''),'</p>',
		 '<p>',Form::label('artista','Artista:'),'<br />',
		 Form::input('artista',''),'</p>',
		 '<p>',Form::submit('recomendar','Recomendar'),'</p>';
?>
</form>

