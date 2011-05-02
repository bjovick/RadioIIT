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
		self::$_horario = Horarios::actual();
		self::$_horario['generos'] = explode(',',self::$_horario['generos']);
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
			->on('canciones.id', '=', 'playlist.cancion_idfk')
			->execute()->as_array();

		return self::$_canciones;
	}

	/**
	 * regresa un array de canciones que estan disponibles de pedir.
	 * disponibles = todas las rolas del horario
	 *						 - las que se tocaron en el lapso minimo de tocada (30mins)
	 *						 - las que estan en el playlist
	 */
	public function disponibles() {
		//capturando el tiempo
		$t = time();
		//lapso de cancion de ultima vez tocada
		$lapso = DB::expr('('.$t.' - UNIX_TIMESTAMP(`ultima_tocada`))');
		//necesita se una exprecion, si no no acepta '
		$in_generos = DB::expr('(\''.implode('\',\'',self::$_horario['generos']).'\')');
		//query de id de canciones en playlist
		$lista_ids = DB::expr('('.DB::select('cancion_idfk')->from('playlist_actual').')');

		$select = DB::select('*')
			->from('canciones')
			//solo las del genero
			->where('genero', 'IN', $in_generos)
			//que no esten en la playlist
			->where('id', 'NOT IN', $lista_ids)
			//solo las que no se han tocado en el lapso minimo (30mins)
			->where($lapso,'>=',intval(Sitio::config('lapso_segs_peticiones_limite')));

		return $select->execute()->as_array();
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
		//agregar cancion de forma atomica
		$sub = DB::select(array(DB::expr('orden + 1'), 'siguiente'))
			->from('playlist_actual')
			->order_by('orden', 'desc')
			->limit(1);
		$insert = DB::insert('playlist_actual');
	}

}
