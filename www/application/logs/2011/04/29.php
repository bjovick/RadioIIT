<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-04-29 07:06:13 --- DEBUG: disponibles sql: SELECT * FROM `canciones` WHERE `genero` IN ('Pop') AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND (1304082373 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800
2011-04-29 09:07:06 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL cuenta/cambiar-contrasena was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 120 ]
2011-04-29 10:07:26 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_ARRAY ~ APPPATH/views/paginas/dashboard.php [ 85 ]
2011-04-29 10:38:11 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_ARRAY ~ APPPATH/classes/controller/cuenta.php [ 10 ]
2011-04-29 14:03:19 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_VARIABLE ~ APPPATH/views/paginas/dashboard.php [ 27 ]
2011-04-29 14:03:52 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_VARIABLE ~ APPPATH/views/paginas/dashboard.php [ 27 ]
2011-04-29 14:04:33 --- ERROR: ErrorException [ 8 ]: Undefined variable: filtro ~ APPPATH/classes/model/horarios.php [ 14 ]
2011-04-29 14:19:49 --- DEBUG: disponibles sql: SELECT * FROM `canciones` WHERE `genero` IN ('Pop') AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND (1304108389 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800
2011-04-29 14:28:54 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view bloques/modificar_enlinea could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
2011-04-29 14:42:06 --- DEBUG: disponibles sql: SELECT * FROM `canciones` WHERE `genero` IN ('Pop') AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND (1304109726 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800
2011-04-29 14:59:09 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_CONSTANT_ENCAPSED_STRING, expecting ',' or ';' ~ APPPATH/views/paginas/dashboard.php [ 57 ]