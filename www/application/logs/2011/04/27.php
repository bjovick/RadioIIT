<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-04-27 08:14:01 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_VARIABLE ~ APPPATH/classes/playlist.php [ 53 ]
2011-04-27 08:15:09 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_VARIABLE ~ APPPATH/classes/playlist.php [ 53 ]
2011-04-27 08:19:07 --- DEBUG: login: got input
2011-04-27 08:19:07 --- DEBUG: login: checking for input errors
2011-04-27 08:19:07 --- DEBUG: login: autentificado!
2011-04-27 13:04:09 --- DEBUG: login: got input
2011-04-27 13:04:09 --- DEBUG: login: checking for input errors
2011-04-27 13:04:09 --- DEBUG: login: autentificado!
2011-04-27 14:17:01 --- DEBUG: disponibles sql: SELECT * FROM `canciones` WHERE `genero` IN ('Rock') AND (UNIX_TIMESTAMP(1303935421) - UNIX_TIMESTAMP(`ultima_tocada`)) < '1800'
2011-04-27 14:19:57 --- DEBUG: disponibles sql: SELECT * FROM `canciones` WHERE `genero` IN ('Rock') AND (1303935597 - UNIX_TIMESTAMP(`ultima_tocada`)) < 1800
2011-04-27 14:24:35 --- DEBUG: disponibles sql: SELECT * FROM `canciones` WHERE `genero` IN ('Rock') AND `id` IS NOT (SELECT `cancion_idfk` FROM `playlist_actual`) AND (1303935875 - UNIX_TIMESTAMP(`ultima_tocada`)) < 1800
2011-04-27 14:24:35 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '(SELECT `cancion_idfk` FROM `playlist_actual`) AND (1303935875 - UNIX_TIMESTAMP(' at line 1 ( SELECT * FROM `canciones` WHERE `genero` IN ('Rock') AND `id` IS NOT (SELECT `cancion_idfk` FROM `playlist_actual`) AND (1303935875 - UNIX_TIMESTAMP(`ultima_tocada`)) < 1800 ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2011-04-27 14:25:09 --- DEBUG: disponibles sql: SELECT * FROM `canciones` WHERE `genero` IN ('Rock') AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND (1303935909 - UNIX_TIMESTAMP(`ultima_tocada`)) < 1800