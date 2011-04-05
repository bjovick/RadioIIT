<?php
require_once 'sistema/config.php';

/**
 * Este index solo es llamado una vez y es el controlador principal.
 * es basado de esta mandera index.php/<control>/<accion>/qualquier/otro/parametro?
 * Por default control y accion es index.
 *
 * Para configurar un control tiene que estar en el CONTROLESPATH
 * y por cada accion hacer un metodo publico con el nombre accion_index
 * y tienen que tener de perdida un metodo llamado accion_index.
 * Una opcion que tiene, es que el sistema antes de llamar la accion llama
 * un metodo llamado anterior y despues de la accion un metodo llamado posterior.
 * Si un metodo no se encuentra con el nombre, por ejemplo si el usuario accede
 * index.php/canciones/explorar entonces el sistema va mas o menos por esta sequencia:
 * $control = new Canciones;
 * $control->anterior();
 * $control->accion_explorar($params);
 * $control->posterior();
 */

$url = URL::obtener();
$ctrl_clase = Utils::nomen($url['controlador'], 'clase');
$accion_metodo = Utils::nomen($url['controlador'], 'metodo');

$ctrl = new $ctrl_clase;
?>
