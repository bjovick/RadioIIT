<?php 
/**
 * Variables
 * $cont_principal => contenido en la columna principal
 * $cont_auxiliar => contenido en la columna de a lado (auxiliar)
 */
$cont_principal = isset($cont_principal) ? $cont_principal : '';
$cont_auxiliar = isset($cont_auxiliar) ? $cont_auxiliar : '';
?>
<div id="mainbar">
	<?php echo $cont_principal;?>
</div>
<div id="sidebar">
	<?php echo $cont_auxiliar;?>
</div>
