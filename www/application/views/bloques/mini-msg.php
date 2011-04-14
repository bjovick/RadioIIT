<?php
/**
 * VARIABLES
 */
$clase = isset($clase)?$clase:'error_msg';
?>
<p <?php echo 'class="'.$clase.'"'; ?>><?php echo $contenido;?></p>
