<?php defined('SISPATH') or die('No se permite accesso directo al archivo.');

/**
 * Principalmente ayuda a crear un array con las diferentes
 * partes de un URL. Hace esto por medio de valores ya predefinidos
 * en PHP por cada peticion de pagina.
 * Tambien tiene unos metodos auxiliares.
 */
class URL {
	public static function obtener() {
		$tmp_long = str_replace($_SERVER['SCRIPT_NAME'],
														'',
														$_SERVER['REQUEST_URI']);
		$tmp_long = '/'.ltrim($tmp_long, '/');
		$url_arr = array();
		$url_arr['raw'] = $tmp_long;

		$qry = $_SERVER['QUERY_STRING'];
		$url_arr['query_str'] = $qry;
		$tmp = explode('&',$qry);
		$url_arr['query'] = array();
		foreach ($tmp as $param) {
			$a = explode('=',$param);
			$url_arr['query'][$a['0']] = empty($a[1]) ? true : $a[1];
		}

		$sp = preg_split('/\//', $tmp_long);
		$url_arr['controlador'] = !empty($sp[1]) ? $sp[1] : 'index';
		$url_arr['accion'] = !empty($sp[2]) ? explode('?', $sp[2]) : 'index';
		$url_arr['accion'] = $url_arr['accion'][0];


		return $url_arr;
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
