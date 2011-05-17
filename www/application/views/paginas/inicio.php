<?php
/**
 * Variables:
 * $anuncio => un breve anuncio
 * $intro => un texto un poco mas largo con la introduccion
 */
$anuncio = isset($anuncio) ? $anuncio : '';
$intro = isset($intro) ? $intro : '';
$auxiliar = isset($auxiliar) ? $auxiliar : '';
?>
<div id="mainbar">
	<?php
	echo HTML::image('media/img/RadioIITlogo.jpg',
										array('alt'=>'RadioIIT',
													'class'=>'float_left',
									));
	echo $anuncio; ?>
	<br class="clear" />
	<h1>Programaci&oacute;n Musical V&iacute;a Web</h1>
	<?php echo $intro; ?>
</div>
<div id="sidebar">
	<?php echo $auxiliar; ?>
</div>
