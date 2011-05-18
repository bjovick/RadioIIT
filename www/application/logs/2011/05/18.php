<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-05-18 09:16:10 --- DEBUG: playlist->disponibles sql: SELECT * FROM `canciones` WHERE (`genero` LIKE '%rock%' OR `genero` IS NULL OR `genero` LIKE '%unkown%') AND `id` NOT IN (SELECT `cancion_idfk` FROM `peticiones`) AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND ((1305731770 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800 OR `ultima_tocada` IS NULL)
2011-05-18 09:29:34 --- ERROR: ErrorException [ 2 ]: date() expects parameter 2 to be long, string given ~ APPPATH/classes/fecha.php [ 154 ]