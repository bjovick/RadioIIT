<?php
 /**
  * Variables:
	*
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

<form id="login" name="login" method="POST" action="<?php echo URL::site('/cuenta/login'); ?>">
<?php
echo '<h4>Entra a tu cuenta</h4>',
		 '<p>',Form::Label('usuario','Usuario:'),'<br />',
		 Form::input('usuario',''),'</p>',
		 '<p>',Form::Label('contrasena','Contrase&ntilde;a:'),'<br />',
		 Form::input('contrasena','',array('type'=>'password')),'</p>',
		 '<p>',Form::submit('enviar','Enviar'),'</p>';
?>
</form>
<p>O <?php echo HTML::anchor('registrate','registrate');?></p>
<?php } ?>
