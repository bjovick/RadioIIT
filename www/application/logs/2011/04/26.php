<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-04-26 08:16:17 --- DEBUG: ensenando playlist, size 1
2011-04-26 08:16:42 --- ERROR: ErrorException [ 1 ]: Call to undefined method Database_Query_Builder_Select::as_array() ~ APPPATH/classes/controller/musica.php [ 16 ]
2011-04-26 08:17:36 --- DEBUG: ensenando playlist, size 3
2011-04-26 08:17:36 --- ERROR: ErrorException [ 8 ]: Undefined index: artista ~ APPPATH/views/bloques/playlist.php [ 44 ]
2011-04-26 08:39:05 --- ERROR: ErrorException [ 1 ]: Call to a member function as_array() on a non-object ~ APPPATH/classes/controller/musica.php [ 16 ]
2011-04-26 08:39:15 --- DEBUG: ensenando playlist, size 3
2011-04-26 08:42:49 --- DEBUG: login: got input
2011-04-26 08:42:49 --- DEBUG: login: checking for input errors
2011-04-26 08:42:49 --- DEBUG: login: autentificado!
2011-04-26 12:55:28 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH/classes/controller/musica.php [ 39 ]
2011-04-26 12:55:39 --- ERROR: ErrorException [ 8 ]: Undefined index: generos ~ APPPATH/views/paginas/musica.php [ 40 ]
2011-04-26 14:16:10 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH/classes/controller/musica.php [ 44 ]
2011-04-26 19:59:16 --- ERROR: ErrorException [ 8 ]: Undefined property: Database_Query_Builder_Select::$execute ~ APPPATH/classes/playlist.php [ 55 ]
2011-04-26 20:00:00 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''(Salsa)'' at line 1 ( SELECT * FROM `canciones` WHERE `genero` IN '(Salsa)' ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2011-04-26 20:05:06 --- DEBUG: el select de disponibles: SELECT * FROM `canciones` WHERE `genero` IN '(Salsa)'
2011-04-26 20:05:06 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''(Salsa)'' at line 1 ( SELECT * FROM `canciones` WHERE `genero` IN '(Salsa)' ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2011-04-26 20:05:53 --- DEBUG: el select de disponibles: SELECT * FROM `canciones` WHERE `genero` IN '(\'Salsa\')'
2011-04-26 20:05:53 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''(\'Salsa\')'' at line 1 ( SELECT * FROM `canciones` WHERE `genero` IN '(\'Salsa\')' ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2011-04-26 20:06:18 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ':' ~ APPPATH/classes/playlist.php [ 54 ]
2011-04-26 20:07:30 --- DEBUG: el select de disponibles: SELECT * FROM `canciones` WHERE `genero` IN ('Salsa')
2011-04-26 20:10:27 --- DEBUG: el select de disponibles: SELECT * FROM `canciones` WHERE `genero` IN ('Salsa')
2011-04-26 20:47:55 --- DEBUG: el select de disponibles: SELECT * FROM `canciones` WHERE `genero` IN ('Salsa')
2011-04-26 20:48:26 --- DEBUG: el select de disponibles: SELECT * FROM `canciones` WHERE `genero` IN ('Salsa,'Rock')
2011-04-26 20:48:26 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'Rock')' at line 1 ( SELECT * FROM `canciones` WHERE `genero` IN ('Salsa,'Rock') ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2011-04-26 20:48:51 --- DEBUG: el select de disponibles: SELECT * FROM `canciones` WHERE `genero` IN ('Salsa','Rock')
2011-04-26 20:57:07 --- DEBUG: el select de disponibles: SELECT * FROM `canciones` WHERE `genero` IN ('Salsa','Rock')
2011-04-26 20:59:37 --- DEBUG: el select de disponibles: SELECT * FROM `canciones` WHERE `genero` IN ('Salsa','Rock')