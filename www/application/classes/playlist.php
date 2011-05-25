<?php defined('SYSPATH') or die('No direct script access.');

class Playlist {
	const CONFLICTO_TIEMPO_DE_TOCAR = 10;
	const CONFLICTO_PETICIONES_POR_USUARIO = 11;
	const CONFLICTO_LAPSO_PETICIONES_LIMITE = 12;

	protected static $_instancia = null;
	protected static $_horario;
	protected static $_canciones;

	public static function instancia() {
		if (is_null(self::$_instancia)) {
			self::$_instancia = new Playlist();
		}

		return self::$_instancia;
	}

	private function __construct() {
		$h = Horarios::actual();
		$h = ($h === false) ? array() : $h;
		if(array_key_exists('generos', $h)) {
			$tmp = explode(',', $h['generos']);
			$h['generos'] = ($tmp[0] == '') ? array() : $tmp;
		}
		self::$_horario = $h;
		self::$_canciones = $this->canciones();
	}
	private function __clone() {}

	/**
	 * regresa un array de las canciones en la playlist
	 * el index de cada cancion es el orden en el que van
	 */
	public function canciones() {
		$this->actualizar();

		$sub = DB::select('cancion_idfk')->from('playlist_actual');
		self::$_canciones = DB::select('*')
			->from('canciones')
			->join(array($sub, 'playlist'), 'INNER')
			->on('canciones.id', '=', 'playlist.cancion_idfk');

		$limite = (int) Sitio::config('no_de_canciones_a_mostrar_en_las_listas');
		if($limite > 0) {
			self::$_canciones->limit($limite);
		}

		return self::$_canciones->execute()->as_array();
	}

	/**
	 * regresa un array de canciones que estan disponibles de pedir.
	 * disponibles = todas las rolas del horario
	 *						 - las que se tocaron en el lapso minimo de tocada (30mins)
	 *						 - las que estan en el playlist
	 */
	public function disponibles() {
		$select = DB::select('*')->from('canciones');

		//capturando el tiempo
		$t = time();
		//lapso de cancion de ultima vez tocada
		$lapso = DB::expr('('.$t.' - UNIX_TIMESTAMP(`ultima_tocada`))');
		$permitir_nulls = (Sitio::config('permitir_mostrar_canciones_sin_genero_en_peticiones')=='true');

		//para evitar where_open y where_close vacios
		if($permitir_nulls || !empty(self::$_horario)) {
			$select->where_open();
			//solamente filtrar si hay horarios
			if(!empty(self::$_horario)) {
				//solo las del genero
				if(!empty(self::$_horario['generos'])) {
					foreach(self::$_horario['generos'] as $hor) {
						$select->or_where('genero', 'LIKE', DB::expr('\'%'.$hor.'%\''));
					}
				}

			}

			//y las que esten nulo o que digan unkown si el admin lo permite
			if($permitir_nulls) {
				$select->or_where('genero', 'IS', DB::expr('NULL'))
						->or_where('genero', 'LIKE', DB::expr('\'%unkown%\''));
			}
			$select->where_close();
		}

		//que no esten en la playlist o peticiones
		$select->and_where('id', 'NOT IN', DB::expr('('.DB::select('cancion_idfk')->from('peticiones').')'))
			->and_where('id', 'NOT IN', DB::expr('('.DB::select('cancion_idfk')->from('playlist_actual').')'))
			//solo las que no se han tocado en el lapso minimo (30mins)
			->and_where_open()
			->or_where($lapso,'>=',
				intval(Sitio::config('limite_de_tiempo_para_reproducir_la_misma_cancion_(segs)')))
			->or_where('ultima_tocada', 'IS', DB::expr('NULL'))
			->and_where_close();
		
		Kohana::$log->add(Log::DEBUG, 'playlist->disponibles sql: '.$select);

		$result = $select->execute()->as_array();
		return ($result[0] == '') ? array() : $result;
	}

	/**
	 * actualizar lista de acuerdo al horario
	 * y tambien quita las que ya se han tocado y mantiene la que se esta
	 * tocando actualmente en la cabeza
	 */
	public function actualizar() {

	}

	/**
	 * agrega la cancion pedida a la lista
	 */
	public function agregar_peticion($cancionid) {
		$u = Auth::usuario();
		$insert = DB::insert('peticiones')
			->columns(array('cancion_idfk','fecha_pedida','usuario_idfk'))
			->values(array($cancionid, Fecha::a_bd(time()), $u['id']));
		
		return !!$insert->execute();
	}

}
