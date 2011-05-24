<?php
 /**
  * Variables:
	* $recaptcha => recaptcha widget
	*/
if (Auth::esta_auth()) {
	$u = Auth::usuario();
	$u['usuario'] = empty($u['usuario']) ? '' : $u['usuario'];
	$msg = Model_Contenidos::leer('inicio.identificado')->get('texto_md');
	$msg = str_replace('::usuario::',$u['usuario'],
										 str_replace('::link::', URL::site('cuenta'), $msg));
	echo Markdown($msg);
} else {
?>

<form id="login" name="login" method="POST" action="<?php echo URL::site('/cuenta/registrate'); ?>">
<?php
echo '<h4>Registrate</h4>',
		 '<p>',Form::label('usuario','Usuario (4 caracteres o mas):'),'<br />',
		 Form::input('usuario',''),'</p>',
		 '<p>',Form::label('contrasena','Contrase&ntilde;a (6 caracteres o mas):'),'<br />',
		 Form::input('contrasena','',array('type'=>'password')),'</p>',
		 '<p>',Form::label('contrasena_repetida','Contrase&ntilde;a otra vez:'),'<br />',
		 Form::input('contrasena_repetida','',array('type'=>'password')),'</p>',
		 '<p>',Form::label('email','Email:'),'<br />',
		 Form::input('email',''),'</p>';
echo empty($recaptcha) ? '' :	 '<p>'.$recaptcha.'</p>';
echo '<p>',Form::submit('enviar','Enviar'),'</p>';
?>
</form>
<?php } ?>
