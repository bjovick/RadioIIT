<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-05-17 19:22:34 --- DEBUG: llave existe?: no
2011-05-17 19:22:34 --- DEBUG: llave existe?: no
2011-05-17 19:22:34 --- DEBUG: llave existe?: no
2011-05-17 19:22:34 --- DEBUG: llave existe?: no
2011-05-17 19:22:34 --- DEBUG: llave existe?: si
2011-05-17 19:22:34 --- DEBUG: llave existe?: si
2011-05-17 19:22:34 --- DEBUG: llave existe?: si
2011-05-17 19:22:34 --- DEBUG: llave existe?: no
2011-05-17 19:24:57 --- DEBUG: llave no__de_peticiones_permitidas_por_usuario existe?: no
2011-05-17 19:24:57 --- DEBUG: llave limite_de_tiempo_para_no__de_peticiones_(segs) existe?: no
2011-05-17 19:24:57 --- DEBUG: llave no__de_recomendaciones_permitidas_por_usuario existe?: no
2011-05-17 19:24:57 --- DEBUG: llave limite_de_tiempo_para_no__de_recomendaciones_(segs) existe?: no
2011-05-17 19:24:57 --- DEBUG: llave limite_de_tiempo_para_reproducir_la_misma_cancion_(segs) existe?: si
2011-05-17 19:24:57 --- DEBUG: llave email_para_recibir_recomendaciones existe?: si
2011-05-17 19:24:57 --- DEBUG: llave permitir_mostrar_canciones_sin_genero_en_peticiones existe?: si
2011-05-17 19:24:57 --- DEBUG: llave no__de_canciones_a_mostrar_en_las_listas existe?: no
2011-05-17 19:27:20 --- ERROR: ErrorException [ 8 ]: Undefined variable: post ~ APPPATH/classes/controller/admin.php [ 14 ]
2011-05-17 19:27:21 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-05-17 19:27:54 --- DEBUG: llave no__de_peticiones_permitidas_por_usuario existe?: no
2011-05-17 19:27:54 --- DEBUG: llave limite_de_tiempo_para_no__de_peticiones_(segs) existe?: no
2011-05-17 19:27:54 --- DEBUG: llave no__de_recomendaciones_permitidas_por_usuario existe?: no
2011-05-17 19:27:54 --- DEBUG: llave limite_de_tiempo_para_no__de_recomendaciones_(segs) existe?: no
2011-05-17 19:27:54 --- DEBUG: llave limite_de_tiempo_para_reproducir_la_misma_cancion_(segs) existe?: si
2011-05-17 19:27:54 --- DEBUG: llave email_para_recibir_recomendaciones existe?: si
2011-05-17 19:27:54 --- DEBUG: llave permitir_mostrar_canciones_sin_genero_en_peticiones existe?: si
2011-05-17 19:27:54 --- DEBUG: llave no__de_canciones_a_mostrar_en_las_listas existe?: no
2011-05-17 19:31:48 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-05-17 19:34:28 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-05-17 19:34:51 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-05-17 19:35:29 --- DEBUG: llave no_de_peticiones_permitidas_por_usuario existe?: si
2011-05-17 19:35:29 --- DEBUG: llave limite_de_tiempo_para_no_de_peticiones_(segs) existe?: si
2011-05-17 19:35:29 --- DEBUG: llave no_de_recomendaciones_permitidas_por_usuario existe?: si
2011-05-17 19:35:29 --- DEBUG: llave limite_de_tiempo_para_no_de_recomendaciones_(segs) existe?: si
2011-05-17 19:35:29 --- DEBUG: llave limite_de_tiempo_para_reproducir_la_misma_cancion_(segs) existe?: si
2011-05-17 19:35:29 --- DEBUG: llave email_para_recibir_recomendaciones existe?: si
2011-05-17 19:35:29 --- DEBUG: llave permitir_mostrar_canciones_sin_genero_en_peticiones existe?: si
2011-05-17 19:35:29 --- DEBUG: llave no_de_canciones_a_mostrar_en_las_listas existe?: si
2011-05-17 20:38:36 --- DEBUG: playlist->disponibles sql: SELECT * FROM `canciones` WHERE (`genero` LIKE '%Indie%' OR `genero` LIKE '%Alternative%' OR `genero` IS NULL OR `genero` LIKE '%unkown%') AND `id` NOT IN (SELECT `cancion_idfk` FROM `peticiones`) AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND ((1305686315 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800 OR `ultima_tocada` IS NULL)
2011-05-17 20:38:47 --- DEBUG: playlist->disponibles sql: SELECT * FROM `canciones` WHERE (`genero` LIKE '%Indie%' OR `genero` LIKE '%Alternative%' OR `genero` IS NULL OR `genero` LIKE '%unkown%') AND `id` NOT IN (SELECT `cancion_idfk` FROM `peticiones`) AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND ((1305686327 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800 OR `ultima_tocada` IS NULL)
2011-05-17 20:41:32 --- ERROR: ErrorException [ 8 ]: Undefined variable: lapso ~ APPPATH/classes/usuario.php [ 19 ]
2011-05-17 20:41:33 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 743 ]
2011-05-17 20:42:11 --- DEBUG: playlist->disponibles sql: SELECT * FROM `canciones` WHERE (`genero` LIKE '%Indie%' OR `genero` LIKE '%Alternative%' OR `genero` IS NULL OR `genero` LIKE '%unkown%') AND `id` NOT IN (SELECT `cancion_idfk` FROM `peticiones`) AND `id` NOT IN (SELECT `cancion_idfk` FROM `playlist_actual`) AND ((1305686531 - UNIX_TIMESTAMP(`ultima_tocada`)) >= 1800 OR `ultima_tocada` IS NULL)