<?php defined('SISPATH') or die('No se permite accesso directo al archivo.');

class Vista { 
	private $_vars;
	private $_archivo;

	public function crear($vista, array $params = array()) {
		return new Vista($vista, $params);
	}

	// Methodos Magicos //
	protected function __construct($vista, array $params) {
		$this->set_filename($vista);
		$this->_vars = $params;
	}

	public function __set($key, $value) {
		$this->set($key, $value);
	}

	public function __isset($key) {
		return isset($this->_vars[$key]);
	}

	public function __unset($key) {
		unset($this->_vars[$key]);
	}

	public function __toString() {
		return $this->presentar();
		/*
		try {
			return $this->presentar();
		} catch (Exception $e) {
			echo 'Error al intepretart vista: '.$e;
			return '';
		}*/
	}

	public function set($key, $value = NULL) {
		$this->_vars[$key] = $value;

		return $this;
	}

	public function set_filename($file) {
		$_file = explode('.', $file);
		$ext = (count($_file) == 2) ? array_pop($_file) : 'php';
		$file = $_file[0].'.'.$ext;
		if(!file_exists(VISTASPATH.$file)) {
			throw new Exception('No se pudo encontrar la vista '.$file.'.');
		}

		$this->_archivo = VISTASPATH.$file;
		return $this;
	}

	public function presentar() {
		if (empty($this->_archivo)) {
			throw new Exception('You must set the file to use within your view before rendering');
		}

		return $this->capturar();
	}

	protected function capturar() {
		// importar las variables de la vista al contexto local
		extract($this->_vars, EXTR_SKIP);

		// empezar a capturar el buffer de la vista
		ob_start();

		try {
			// cargando el archivo de la vista
			include $this->_archivo;
		}	catch (Exception $e) {
			// limpiando el buffer antes de mandar la excepcion
			ob_end_clean();

			throw $e;
		}

		// capturar el resultado y limpiar el buffer
		return ob_get_clean();
	}
}
