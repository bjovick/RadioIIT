<?php defined('SYSPATH') or die('No direct script access.');

class Canciones {
	public static function mas_pedidas($limite = 10) {
		return DB::select('*')
			->from('canciones')
			->order_by('cantidad_pedidas', 'desc')
			->limit($limite)
			->execute();
	}
}
