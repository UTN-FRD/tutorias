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
				'message'    => 'La respuesta es inválido'
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
				// Numeros decimales con signo.
				return preg_match('/^[+-]?[0-9]+(\.[0-9]+)?$/', $respuesta);
			case Pregunta::TIPO_MENU:
				// Misma validación que para 'Radio Button'.
			case Pregunta::TIPO_RADIO:
				// Enteros positivos menores a la cantidad de respuestas posibles.
				return (ctype_digit($respuesta)) && (intval($respuesta) < count($valores));
			case Pregunta::TIPO_CHECKBOX:
				// Vector cuyos elementos sean enteros positivos menores a la cantidad de respuestas posibles.
				$checkboxs = explode(',', $respuesta);
				foreach ($checkboxs as $checkbox) {
					if (!ctype_digit($checkbox) || (intval($checkbox) >= count($valores))) {
						return false;
					}
				}

				// Verifico que no existan valores repetidos en la respuesta.
				return array_unique($checkboxs) === $checkboxs;
			case Pregunta::TIPO_TEXTO:
				// Cualquier valor.
				return true;
		}

		return false;
	}

	public function crearEncuesta($estudiante) {
		$preguntas = $this->Pregunta->find('list', array(
			'conditions' => array(
				'Pregunta.activo' => '1',
				'Pregunta.carrera_id' => array(
					$estudiante['carrera_id'],
					$this->Pregunta->Carrera->findByNombre("todas")['Carrera']['id']
				)
			)
		));

		foreach ($preguntas as $pregunta) {
			$this->create();
			$data = array('estudiante_id' => $estudiante['id'], 'pregunta_id' => $pregunta);
			$this->save($data);
		}

		return true;
	}

	public function eliminarEncuesta($estudiante) {
		$this->deleteAll(array('estudiante_id' => $estudiante['id']));
		return true;
	}

	public function regenerarEncuesta($estudiante) {
		$this->eliminarEncuesta($estudiante);
		$this->crearEncuesta($estudiante);

		return true;
	}
}
