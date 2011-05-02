<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-05-01 12:28:17 --- DEBUG: disponibles sql: SELECT * FROM `canciones` WHERE `genero` IN ('Rock') AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND (1304274497 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800
2011-05-01 12:28:30 --- DEBUG: disponibles sql: SELECT * FROM `canciones` WHERE `genero` IN ('Rock') AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND (1304274510 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800
2011-05-01 13:04:08 --- DEBUG: disponibles sql: SELECT * FROM `canciones` WHERE `genero` IN ('Rock') AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND (1304276648 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800
2011-05-01 17:35:24 --- DEBUG: disponibles sql: SELECT * FROM `canciones` WHERE `genero` IN ('Rock') AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND (1304292924 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800
2011-05-01 17:35:58 --- ERROR: ErrorException [ 8 ]: Undefined index: titulo ~ APPPATH/classes/controller/musica.php [ 60 ]
2011-05-01 17:36:38 --- ERROR: ErrorException [ 8 ]: Undefined index: titulo ~ APPPATH/classes/controller/musica.php [ 60 ]
2011-05-01 17:36:44 --- DEBUG: disponibles sql: SELECT * FROM `canciones` WHERE `genero` IN ('Rock') AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND (1304293004 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800
2011-05-01 17:37:11 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected $end, expecting T_FUNCTION ~ APPPATH/classes/usuario.php [ 63 ]
2011-05-01 17:38:21 --- ERROR: ErrorException [ 1 ]: Call to undefined method Usuario::leer() ~ APPPATH/views/paginas/dashboard.php [ 57 ]
2011-05-01 17:39:01 --- ERROR: ErrorException [ 1 ]: Class 'Model_Usuario' not found ~ APPPATH/views/paginas/dashboard.php [ 57 ]
2011-05-01 17:39:11 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH/classes/fecha.php [ 142 ]
2011-05-01 18:06:19 --- ERROR: ErrorException [ 1 ]: Call to undefined method Date::formated_time() ~ APPPATH/views/paginas/dashboard.php [ 58 ]
2011-05-01 18:10:13 --- ERROR: ErrorException [ 8 ]: A non well formed numeric value encountered ~ APPPATH/classes/fecha.php [ 152 ]
2011-05-01 18:11:21 --- ERROR: ErrorException [ 1 ]: Call to undefined method Fecha::fecha() ~ APPPATH/classes/fecha.php [ 111 ]
2011-05-01 18:12:32 --- ERROR: ErrorException [ 8 ]: Undefined variable: local_timestamp ~ APPPATH/classes/fecha.php [ 11 ]
2011-05-01 18:22:01 --- DEBUG: disponibles sql: SELECT * FROM `canciones` WHERE `genero` IN ('Rock') AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND (1304295721 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800