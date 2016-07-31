<?php
App::uses('AppModel', 'Model');

class Encuesta extends AppModel {
	public $belongsTo = array(
		'Estudiante' => array(
			'className'  => 'Estudiante'
		),
		'Pregunta' => array(
			'className'  => 'Pregunta'
		)
	);

	public $validate = array(
		'respuesta' => array(
			'valid' => array(
				'rule'       => 'validarTipo',
				'allowEmpty' => true,
				'message'    => 'La respuesta es inválida'
			)
		)
	);

	public function validarTipo($check) {
		$encuesta = $this->findById($this->id);
		$respuesta = array_values($check)[0];
		$valores = explode(',', $encuesta['Pregunta']['valores']);

		$tipo = $encuesta['Pregunta']['tipo'];
		switch ($tipo) {
			case Pregunta::TIPO_NUMERICO:
				// Números decimales con signo.
				return preg_match('/^[+-]?[0-9]+(\.[0-9]+)?$/', $respuesta);
			case Pregunta::TIPO_MENU:
				// Misma validación que para 'Radio Button'.
			case Pregunta::TIPO_RADIO:
				// Enteros positivos menores a la cantidad de respuestas posibles.
				return (ctype_digit($respuesta)) && (intval($respuesta) < count($valores));
			case Pregunta::TIPO_CHECKBOX:
				// Vector cuyos elementos sean enteros positivos menores a la cantidad de respuestas posibles.
				if (!is_array($respuesta)) {
					return false;
				}

				foreach ($respuesta as $checkbox) {
					if (!ctype_digit($checkbox) || (intval($checkbox) >= count($valores))) {
						return false;
					}
				}

				// Verifico que no existan valores repetidos en la respuesta.
				return array_unique($respuesta) === $respuesta;
			case Pregunta::TIPO_FECHA:
				// Fecha valida y que se encuentre entre el 1/1/1900 y el 31/12/2099.
				$dateTime = DateTime::createFromFormat('d/m/Y', $respuesta);

				$errors = DateTime::getLastErrors();
				if (!$dateTime || !empty($errors['warning_count'])) {
					return false;
				}

				$year = $dateTime->format('Y');

				return ($year >= 1900) && ($year <= 2099);
			case Pregunta::TIPO_TEXTO:
				// String de hasta 65535 caracteres.
				return (strlen($respuesta) <= 65535);
		}

		return false;
	}

	/**
	 * Si la pregunta de la encuesta en del tipo checkbox, transforma al array de respuestas
	 * en un string donde las respuestas estan separadas por comas.
	 */
	public function beforeSave($options = array()) {
		$pregunta = $this->Pregunta->findById($this->data['Encuesta']['pregunta_id']);

		if ($pregunta['Pregunta']['tipo'] == Pregunta::TIPO_CHECKBOX && !empty($this->data['Encuesta']['respuesta'])) {
			$this->data['Encuesta']['respuesta'] = implode(",", $this->data['Encuesta']['respuesta']);
		}

		return true;
	}

	public function crear($estudiante_id) {
		$this->Estudiante->id = $estudiante_id;

		$preguntas = $this->Pregunta->find('list', array(
			'conditions' => array(
				'Pregunta.activo' => '1',
				'Pregunta.carrera_id' => array(
					$this->Estudiante->field('carrera_id'),
					$this->Pregunta->Carrera->findByNombre('todas')['Carrera']['id']
				)
			)
		));

		foreach ($preguntas as $pregunta) {
			$this->create();
			$data = array('estudiante_id' => $estudiante_id, 'pregunta_id' => $pregunta);
			$this->save($data);
		}

		return true;
	}

	public function eliminar($estudiante_id) {
		return $this->deleteAll(array('estudiante_id' => $estudiante_id));
	}

	public function regenerar($estudiante_id) {
		$this->eliminar($estudiante_id);
		$this->crear($estudiante_id);

		return true;
	}
}
