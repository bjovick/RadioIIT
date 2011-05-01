<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-04-30 10:44:06 --- ERROR: ErrorException [ 1 ]: Class 'Usuarios' not found ~ APPPATH/views/paginas/dashboard.php [ 80 ]
2011-04-30 10:44:35 --- ERROR: ErrorException [ 8 ]: Undefined variable: filtro ~ APPPATH/classes/model/usuarios.php [ 14 ]
2011-04-30 13:29:43 --- ERROR: ErrorException [ 1 ]: Call to undefined method Database_Query_Builder_Select::as_array() ~ APPPATH/classes/sitio.php [ 24 ]
2011-04-30 13:44:47 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: media/js/jquery-1.5.min.js ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-04-30 13:45:11 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: media/js/jquery-1.5.min.js ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-04-30 13:45:36 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: media/js/jquery-1.5.min.js ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-04-30 13:46:57 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: media/js/jquery-1.5.min.js ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-04-30 13:47:09 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: media/js/jquery-1.5.min.js ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-04-30 13:47:20 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: media/js/jquery-1.5.min.js ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-04-30 13:47:29 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: media/js/jquery-1.5.min.js ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-04-30 13:47:36 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: cuenta/media/js/jquery-1.5.min.js ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-04-30 13:47:43 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: media/js/jquery-1.5.min.js ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-04-30 13:49:31 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: media/js/jquery-1.5.min.js ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-04-30 13:51:32 --- DEBUG: disponibles sql: SELECT * FROM `canciones` WHERE `genero` IN ('Hip Hop') AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND (1304193092 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800