<?php
/** Global **/
define('URLROOT', '/');
define('DOCROOT', dirname(realpath(dirname(__FILE__))).DIRECTORY_SEPARATOR);
define('SISPATH', DOCROOT.'sistema'.DIRECTORY_SEPARATOR);
define('ASSETSPATH', DOCROOT.'assets'.DIRECTORY_SEPARATOR);
define('VISTASPATH', DOCROOT.'vistas'.DIRECTORY_SEPARATOR);
define('CONTROLESPATH', DOCROOT.'controles'.DIRECTORY_SEPARATOR);

/**
 * DEV: environment use E_ALL | E_STRICT
 * PROD: E_ALL ^ E_NOTICE
 */
error_reporting(E_ALL | E_STRICT);

date_default_timezone_set('America/Chihuahua');

setlocale(LC_ALL, 'es_MX.utf-8');

/** Entorno **/
require SISPATH.'Nucleo.php';
spl_autoload_register(array('Nucleo','auto_load'));



