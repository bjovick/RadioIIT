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
													'class'=>'central'));
	?>
		<div class="anuncio"><?php echo $anuncio; ?></strong></div>
	<h2>Programaci&oacute;n Musical V&iacute;a Web</h2>
	<?php echo $intro; ?>
</div>
<div id="sidebar">
	<?php echo $auxiliar; ?>
</div>
