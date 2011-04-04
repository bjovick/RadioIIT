<?php defined('SISPATH') or die('No se permite accesso directo al archivo.');

/**
 * Principalmente ayuda a crear un array con las diferentes
 * partes de un URL. Hace esto por medio de valores ya predefinidos
 * en PHP por cada peticion de pagina.
 * Tambien tiene unos metodos auxiliares.
 */
class URL {
	public static function obtener() {
		$url_arr = array();
		/**
		 * http://radioiit.tonylara.net/werewkjwe/kwunjnhf?ewer&weiwe=0932
		 * [QUERY_STRING] => ewer&weiwe=0932
		 * [REDIRECT_QUERY_STRING] => ewer&weiwe=0932
		 * [REDIRECT_URL] => /werewkjwe/kwunjnhf
		 * [REQUEST_URI] => /werewkjwe/kwunjnhf?ewer&weiwe=0932
		 * [SCRIPT_FILENAME] => /home/tonylar1/public_html/radioiit/index.php
		 * [SCRIPT_NAME] => /index.php
		 */
	}
}
