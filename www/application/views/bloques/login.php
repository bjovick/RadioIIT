<?php
 /**
  * Variables:
	*
	*/
?>

<form id="login" name="login" method="POST" action="<?php echo URL::site('login'); ?>">
<?php
echo '<h4>Entra a tu cuenta</h4>',
		 '<p>',Form::Label('usuario','Usuario:'),'<br />',
		 Form::input('usuario',''),'</p>',
		 '<p>',Form::Label('contrasena','Contrase&ntilde;a:'),'<br />',
		 Form::input('contasena','',array('type'=>'password')),'</p>',
		 '<p>',Form::submit('enviar','Enviar'),'</p>';
?>
</form>
<p>O <?php echo HTML::anchor('registrate','registrate');?></p>
