<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-05-02 10:10:30 --- ERROR: ErrorException [ 1 ]: Call to undefined method Database_MySQL_Result::curret() ~ APPPATH/views/bloques/modificar_usuario.php [ 8 ]
2011-05-02 10:17:21 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ';' ~ APPPATH/classes/controller/admin.php [ 50 ]
2011-05-02 10:26:22 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_VARIABLE, expecting ',' or ';' ~ APPPATH/classes/controller/admin.php [ 73 ]
2011-05-02 10:28:06 --- ERROR: ErrorException [ 8 ]: Undefined index: nueva_contrasena_respendida ~ APPPATH/classes/controller/admin.php [ 53 ]
2011-05-02 10:58:12 --- ERROR: ErrorException [ 8 ]: Undefined variable: id ~ APPPATH/views/bloques/modificar_usuario.php [ 9 ]
2011-05-02 10:59:29 --- DEBUG: Playlist::disponible sql: SELECT * FROM `canciones` WHERE (`genero` IN ('') OR `genero` IS NULL OR `genero` LIKE '%unkown%') AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND (1304355569 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800