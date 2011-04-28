<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-04-28 13:24:20 --- ERROR: ErrorException [ 8 ]: Undefined variable: horarios ~ APPPATH/views/paginas/dashboard.php [ 22 ]
2011-04-28 13:48:46 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected $end ~ APPPATH/views/paginas/dashboard.php [ 81 ]
2011-04-28 15:29:35 --- DEBUG: disponibles sql: SELECT * FROM `canciones` WHERE `genero` IN ('Rock') AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND (1304026175 - UNIX_TIMESTAMP(`ultima_tocada`)) < 1800
2011-04-28 15:33:46 --- DEBUG: disponibles sql: SELECT * FROM `canciones` WHERE `genero` IN ('Rock') AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND (1304026426 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800