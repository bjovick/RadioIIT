<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-05-01 12:28:17 --- DEBUG: disponibles sql: SELECT * FROM `canciones` WHERE `genero` IN ('Rock') AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND (1304274497 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800
2011-05-01 12:28:30 --- DEBUG: disponibles sql: SELECT * FROM `canciones` WHERE `genero` IN ('Rock') AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND (1304274510 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800