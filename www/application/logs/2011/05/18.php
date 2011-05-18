<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-05-18 09:16:10 --- DEBUG: playlist->disponibles sql: SELECT * FROM `canciones` WHERE (`genero` LIKE '%rock%' OR `genero` IS NULL OR `genero` LIKE '%unkown%') AND `id` NOT IN (SELECT `cancion_idfk` FROM `peticiones`) AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND ((1305731770 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800 OR `ultima_tocada` IS NULL)
2011-05-18 09:29:34 --- ERROR: ErrorException [ 2 ]: date() expects parameter 2 to be long, string given ~ APPPATH/classes/fecha.php [ 154 ]
2011-05-18 13:25:33 --- ERROR: Database_Exception [ 0 ]: [1045] Access denied for user 'a11117ho_db'@'localhost' (using password: YES) ~ MODPATH/database/classes/kohana/database/mysql.php [ 67 ]
2011-05-18 13:25:33 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 743 ]