<?php
/**
 * Dependencias
 */
App::uses('AppHelper', 'View');

/**
 * Ayudante de la plataforma.
 */
class PlataformaHelper extends AppHelper {

/**
 * Ayudantes
 *
 * @var array
 */
	public $helpers = array('Html');

/**
 * Obtiene la versión de la plataforma.
 *
 * @param bool $link Indica si se devuelve un enlace HTML.
 *
 * @return string
 */
	public function obtenerVersion($link = true) {
		$archivo = APP . 'Config' . DS . 'VERSION.txt';
		$version = 'master';

		if (file_exists($archivo)) {
			$hash = file_get_contents($archivo);
			if (!empty($hash)) {
				$version = substr($hash, 0, 7);
			}
		}

		return !$link ? $version : $this->Html->link($version, "https://github.com/UTN-FRD/tutorias/tree/$version",
			array('target' => '_blank'));
	}

/**
 * Obtiene el título de la plataforma.
 *
 * @param string|null $texto Especifica una cadena adicional para el título.
 *
 * @return string
 */
	public function obtenerTitulo($texto = null) {
		$titulo = !$this->esGraduados() ? 'Tutorías' : 'Graduados';
		if ($texto) {
			$titulo .= " - $texto";
		}

		return h($titulo);
	}

/**
 * Obtiene el encuestado de la plataforma
 *
 * @param string|null $texto Especifica una cadena adicional para el encuestado.
 *
 * @return string
 */
	public function obtenerEncuestado($texto = null) {
		$titulo = !$this->esGraduados() ? 'Estudiantes' : 'Graduados';
		if ($texto) {
			$titulo .= " - $texto";
		}

		return h($titulo);
	}

/**
 * Obtiene el ID de los usuarios de la plataforma
 *
 * @param string|null $texto Especifica una cadena adicional para el ID.
 *
 * @return string
 */
	public function obtenerID($texto = null) {
		$titulo = !$this->esGraduados() ? 'Legajo' : 'DNI';
		if ($texto) {
			$titulo .= " - $texto";
		}

		return h($titulo);
	}

/**
 * Obtiene el nombre de los usuarios de la plataforma
 *
 * @param string|null $texto Especifica una cadena adicional para el usuario.
 *
 * @return string
 */
	public function obtenerUsuario($texto = null) {
		$titulo = !$this->esGraduados() ? 'Tutor' : 'Usuario';
		if ($texto) {
			$titulo .= " - $texto";
		}

		return h($titulo);
	}


/**
 * Comprueba si la instalación corresponde a la versión de Graduados.
 *
 * @return bool
 */
	public function esGraduados() {
		if (!Configure::check('Plataforma.Graduados')) {
			return stripos(__FILE__, 'graduados') !== false;
		}

		return Configure::read('Plataforma.Graduados') === true;
	}
}
