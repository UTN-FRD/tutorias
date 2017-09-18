<?php
/**
 * Dependencias
 */
App::uses('Configure', 'Core');

/**
 * Plataforma
 */
class Plataforma {

/**
 * Almacena la versión de la plataforma.
 *
 * @var string
 */
	private static $__version = 'master';

/**
 * Obtiene la versión de la plataforma.
 *
 * @return string
 */
	public function obtenerVersion() {
		$archivo = APP . 'Config' . DS . 'VERSION.txt';
		if (file_exists($archivo)) {
			$hash = file_get_contents($archivo);
			if (!empty($hash)) {
				self::$__version = substr($hash, 0, 7);
			}
		}

		return self::$__version;
	}

/**
 * Comprueba si la instalación corresponde a la versión de Tutorías.
 *
 * @return bool
 */
	public static function esTutorias() {
		return stripos(__FILE__, 'tutorias') !== false;
	}
}
