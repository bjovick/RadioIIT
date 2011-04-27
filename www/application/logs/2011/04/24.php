<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-04-24 15:09:15 --- DEBUG: login: got input
2011-04-24 15:09:15 --- DEBUG: login: checking for input errors
2011-04-24 15:09:15 --- DEBUG: login: autentificado!
2011-04-24 18:10:13 --- ERROR: ErrorException [ 8 ]: Undefined variable: instance ~ APPPATH/classes/playlist.php [ 13 ]
2011-04-24 18:10:34 --- ERROR: ErrorException [ 1 ]: Class 'Horario' not found ~ APPPATH/classes/playlist.php [ 21 ]
2011-04-24 18:10:52 --- ERROR: ErrorException [ 1 ]: Class 'Horario' not found ~ APPPATH/classes/horarios.php [ 25 ]
2011-04-24 18:11:27 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'tiempo_inicio' in 'where clause' ( SELECT * FROM `horarios` WHERE `dia` = 'domingo' AND `tiempo_inicio` = '18:11:27' ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2011-04-24 18:20:13 --- ERROR: ErrorException [ 8 ]: Undefined index: genero ~ APPPATH/classes/controller/musica.php [ 13 ]
2011-04-24 18:21:37 --- ERROR: ErrorException [ 1 ]: Call to a member function canciones() on a non-object ~ APPPATH/classes/controller/musica.php [ 20 ]
2011-04-24 18:37:14 --- DEBUG: adentro de view/bloques/playlist
2011-04-24 18:37:14 --- DEBUG: adentro de view/bloques/playlist
2011-04-24 18:38:04 --- DEBUG: adentro de view/bloques/playlist
2011-04-24 18:38:04 --- DEBUG: adentro de view/bloques/playlist
2011-04-24 18:55:55 --- DEBUG: adentro de view/bloques/playlist
2011-04-24 18:55:55 --- ERROR: ErrorException [ 8 ]: Undefined index: genero ~ APPPATH/views/bloques/playlist.php [ 34 ]
2011-04-24 18:55:55 --- DEBUG: adentro de view/bloques/playlist
2011-04-24 18:55:55 --- ERROR: ErrorException [ 8 ]: Undefined index: genero ~ APPPATH/views/bloques/playlist.php [ 34 ]
2011-04-24 18:56:46 --- DEBUG: adentro de view/bloques/playlist
2011-04-24 18:56:46 --- DEBUG: ensenando playlist
2011-04-24 18:56:46 --- DEBUG: adentro de view/bloques/playlist
2011-04-24 18:56:46 --- DEBUG: ensenando playlist
2011-04-24 19:01:10 --- ERROR: Database_Exception [ 0 ]: [1146] Table 'radioiit.playlist' doesn't exist ( SELECT * FROM `playlist` ORDER BY `orden` ASC ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2011-04-24 19:01:37 --- DEBUG: adentro de view/bloques/playlist
2011-04-24 19:01:37 --- DEBUG: adentro de view/bloques/playlist