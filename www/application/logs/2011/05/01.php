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
2011-05-01 19:01:11 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ':' ~ APPPATH/classes/fecha.php [ 166 ]
2011-05-01 19:01:38 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ':' ~ APPPATH/classes/fecha.php [ 172 ]
2011-05-01 19:01:47 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected $end, expecting T_FUNCTION ~ APPPATH/classes/fecha.php [ 177 ]
2011-05-01 19:12:21 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_CONSTANT_ENCAPSED_STRING ~ APPPATH/classes/controller/musica.php [ 49 ]
2011-05-01 19:13:27 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_CONSTANT_ENCAPSED_STRING ~ APPPATH/classes/controller/musica.php [ 49 ]
2011-05-01 19:13:59 --- DEBUG: Playlist::disponible sql: SELECT * FROM `canciones` WHERE `genero` IN ('Rock') AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND (1304298839 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800
2011-05-01 19:15:19 --- ERROR: ErrorException [ 2048 ]: Non-static method Playlist::agregar_peticion() should not be called statically, assuming $this from incompatible context ~ APPPATH/classes/controller/musica.php [ 42 ]
2011-05-01 19:15:56 --- DEBUG: Playlist::disponible sql: SELECT * FROM `canciones` WHERE `genero` IN ('Rock') AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND (1304298956 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800
2011-05-01 19:16:02 --- ERROR: ErrorException [ 2048 ]: Non-static method Playlist::agregar_peticion() should not be called statically, assuming $this from incompatible context ~ APPPATH/classes/controller/musica.php [ 42 ]
2011-05-01 19:17:08 --- ERROR: ErrorException [ 1 ]: Call to undefined method Playlist::peticion_es_valida() ~ APPPATH/classes/controller/musica.php [ 40 ]
2011-05-01 19:17:41 --- DEBUG: Playlist::disponible sql: SELECT * FROM `canciones` WHERE `genero` IN ('Rock') AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND (1304299061 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800
2011-05-01 19:20:03 --- DEBUG: Playlist::disponible sql: SELECT * FROM `canciones` WHERE `genero` IN ('Rock') AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND (1304299203 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800
2011-05-01 19:24:50 --- DEBUG: playlist->agregar_peticion sql: INSERT INTO `playlist_actual` (`candion_idfk`, `orden`) VALUES (44, (SELECT orden + 1 AS `siguiente` FROM `playlist_actual` ORDER BY `orden` DESC LIMIT 1))
2011-05-01 19:31:18 --- DEBUG: playlist->agregar_peticion sql: INSERT INTO `playlist_actual` (`candion_idfk`, `orden`) VALUES (48, (SELECT (max(orden) + 1) FROM `playlist_actual`))
2011-05-01 19:49:14 --- DEBUG: playlist->agregar_peticion sql: INSERT INTO `playlist_actual` () SELECT `76`, (max(`orden`) + 1) FROM `playlist_actual`
2011-05-01 19:50:17 --- DEBUG: playlist->agregar_peticion sql: INSERT INTO `playlist_actual` (`cancion_idfk`, `orden`) SELECT `78`, (max(`orden`) + 1) FROM `playlist_actual`
2011-05-01 19:51:08 --- DEBUG: playlist->agregar_peticion sql: INSERT INTO `playlist_actual` (`cancion_idfk`, `orden`) SELECT 79, (max(`orden`) + 1) FROM `playlist_actual`
2011-05-01 19:52:02 --- DEBUG: playlist->agregar_peticion sql: INSERT INTO `playlist_actual` (`cancion_idfk`, `orden`) SELECT 113, (max(`orden`) + 1) FROM `playlist_actual`