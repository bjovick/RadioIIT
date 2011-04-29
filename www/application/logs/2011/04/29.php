<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-04-29 07:06:13 --- DEBUG: disponibles sql: SELECT * FROM `canciones` WHERE `genero` IN ('Pop') AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND (1304082373 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800
2011-04-29 09:07:06 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL cuenta/cambiar-contrasena was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 120 ]
2011-04-29 10:07:26 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_ARRAY ~ APPPATH/views/paginas/dashboard.php [ 85 ]
2011-04-29 10:38:11 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_ARRAY ~ APPPATH/classes/controller/cuenta.php [ 10 ]