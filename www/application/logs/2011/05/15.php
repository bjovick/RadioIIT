<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-05-15 20:36:32 --- ERROR: ErrorException [ 8 ]: Undefined index: artista ~ APPPATH/views/bloques/playlist.php [ 39 ]
2011-05-15 20:49:16 --- DEBUG: playlist->disponibles sql: SELECT * FROM `canciones` WHERE (`genero` LIKE '%%' OR `genero` IS NULL OR `genero` LIKE '%unkown%') AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND `id` NOT IN (SELECT `cancion_idfk` FROM `peticiones`) AND (1305514156 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800
2011-05-15 20:54:46 --- DEBUG: playlist->disponibles sql: SELECT * FROM `canciones` WHERE (`genero` LIKE '%%' OR `genero` IS NULL OR `genero` LIKE '%unkown%') AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND `id` NOT IN (SELECT `cancion_idfk` FROM `peticiones`) AND (1305514486 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800
2011-05-15 21:04:05 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_IF ~ APPPATH/classes/playlist.php [ 68 ]
2011-05-15 21:04:05 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-05-15 21:04:27 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_IF ~ APPPATH/classes/playlist.php [ 68 ]
2011-05-15 21:04:27 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-05-15 21:04:49 --- DEBUG: playlist->disponibles sql: SELECT * FROM `canciones` WHERE `genero` LIKE '%%' OR `genero` IS NULL OR `genero` LIKE '%unkown%' AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND `id` NOT IN (SELECT `cancion_idfk` FROM `peticiones`) AND (1305515089 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800
2011-05-15 21:05:53 --- DEBUG: playlist->disponibles sql: SELECT * FROM `canciones` WHERE `genero` LIKE '%%' OR `genero` IS NULL OR `genero` LIKE '%unkown%' AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND `id` NOT IN (SELECT `cancion_idfk` FROM `peticiones`) AND (1305515153 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800
2011-05-15 21:08:33 --- DEBUG: playlist->disponibles sql: SELECT * FROM `canciones` WHERE `genero` IS NULL OR `genero` LIKE '%unkown%' AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND `id` NOT IN (SELECT `cancion_idfk` FROM `peticiones`) AND (1305515313 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800
2011-05-15 21:10:08 --- DEBUG: playlist->disponibles sql: SELECT * FROM `canciones` WHERE `genero` IS NULL OR `genero` LIKE '%unkown%' AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND `id` NOT IN (SELECT `cancion_idfk` FROM `peticiones`) AND (1305515408 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800
2011-05-15 21:12:41 --- DEBUG: playlist->disponibles sql: SELECT * FROM `canciones` WHERE `genero` IS NULL OR `genero` LIKE '%unkown%' AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND `id` NOT IN (SELECT `cancion_idfk` FROM `peticiones`) AND (1305515561 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800