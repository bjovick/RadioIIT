<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-05-16 12:10:19 --- DEBUG: playlist->disponibles sql: SELECT * FROM `canciones` WHERE `genero` LIKE '%rock%' OR `genero` LIKE '%Pop%' OR `genero` IS NULL OR `genero` LIKE '%unkown%' AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND `id` NOT IN (SELECT `cancion_idfk` FROM `peticiones`) AND (1305569419 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800
2011-05-16 12:52:32 --- ERROR: ErrorException [ 8 ]: Undefined property: Database_Query_Builder_Select::$execute ~ APPPATH/classes/playlist.php [ 61 ]
2011-05-16 12:52:32 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-05-16 12:53:04 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'candion_idfk' in 'field list' ( SELECT `candion_idfk` FROM `playlist_actual` ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2011-05-16 12:53:05 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-05-16 12:53:26 --- ERROR: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH/classes/playlist.php [ 62 ]
2011-05-16 12:53:26 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-05-16 12:54:14 --- ERROR: ErrorException [ 8 ]: Array to string conversion ~ APPPATH/classes/playlist.php [ 84 ]
2011-05-16 12:54:14 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-05-16 12:55:39 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_VARIABLE ~ APPPATH/classes/playlist.php [ 65 ]
2011-05-16 12:55:39 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-05-16 12:55:55 --- ERROR: ErrorException [ 8 ]: Array to string conversion ~ APPPATH/classes/playlist.php [ 84 ]
2011-05-16 12:55:56 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-05-16 13:03:15 --- ERROR: ErrorException [ 8 ]: Array to string conversion ~ APPPATH/classes/playlist.php [ 84 ]
2011-05-16 13:03:15 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-05-16 13:04:10 --- ERROR: ErrorException [ 8 ]: Array to string conversion ~ APPPATH/classes/playlist.php [ 84 ]
2011-05-16 13:04:10 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-05-16 13:08:38 --- ERROR: ErrorException [ 2 ]: Illegal offset type ~ APPPATH/classes/playlist.php [ 88 ]
2011-05-16 13:08:38 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-05-16 13:10:36 --- ERROR: ErrorException [ 8 ]: Array to string conversion ~ APPPATH/classes/playlist.php [ 90 ]
2011-05-16 13:10:36 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-05-16 13:11:38 --- ERROR: ErrorException [ 8 ]: Undefined index: candion_idfk ~ APPPATH/classes/playlist.php [ 88 ]
2011-05-16 13:11:38 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-05-16 13:11:52 --- DEBUG: playlist->disponibles sql: SELECT * FROM `canciones` WHERE (`genero` LIKE '%rock%' OR `genero` LIKE '%Pop%') OR `genero` IS NULL OR `genero` LIKE '%unkown%' AND `id` NOT IN (1,33) AND (1305573112 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800
2011-05-16 13:12:20 --- DEBUG: playlist->disponibles sql: SELECT * FROM `canciones` WHERE (`genero` LIKE '%rock%' OR `genero` LIKE '%Pop%') OR `genero` IS NULL OR `genero` LIKE '%unkown%' AND `id` NOT IN (1,33) AND (1305573140 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800
2011-05-16 13:13:53 --- DEBUG: playlist->disponibles sql: SELECT * FROM `canciones` WHERE (`genero` LIKE '%rock%' OR `genero` LIKE '%Pop%' OR `genero` IS NULL OR `genero` LIKE '%unkown%') AND `id` NOT IN (1,33) AND (1305573233 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800
2011-05-16 13:17:34 --- DEBUG: playlist->disponibles sql: SELECT * FROM `canciones` WHERE (`genero` LIKE '%rock%' OR `genero` LIKE '%Pop%' OR `genero` IS NULL OR `genero` LIKE '%unkown%') AND `id` NOT IN SELECT `cancion_idfk` FROM `peticiones` AND `id` NOT IN SELECT `cancion_idfk` FROM `playlist_actual` AND (1305573454 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800
2011-05-16 13:17:34 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'SELECT `cancion_idfk` FROM `peticiones` AND `id` NOT IN SELECT `cancion_idfk` FR' at line 1 ( SELECT * FROM `canciones` WHERE (`genero` LIKE '%rock%' OR `genero` LIKE '%Pop%' OR `genero` IS NULL OR `genero` LIKE '%unkown%') AND `id` NOT IN SELECT `cancion_idfk` FROM `peticiones` AND `id` NOT IN SELECT `cancion_idfk` FROM `playlist_actual` AND (1305573454 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800 ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2011-05-16 13:17:34 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-05-16 13:19:31 --- DEBUG: playlist->disponibles sql: SELECT * FROM `canciones` WHERE (`genero` LIKE '%rock%' OR `genero` LIKE '%Pop%' OR `genero` IS NULL OR `genero` LIKE '%unkown%') AND `id` NOT IN (SELECT `cancion_idfk` FROM `peticiones`) AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND (1305573571 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800
2011-05-16 13:20:12 --- DEBUG: playlist->disponibles sql: SELECT * FROM `canciones` WHERE (`genero` LIKE '%rock%' OR `genero` LIKE '%Pop%' OR `genero` IS NULL OR `genero` LIKE '%unkown%') AND `id` NOT IN (SELECT `cancion_idfk` FROM `peticiones`) AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND (1305573612 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800