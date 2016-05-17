<?php
App::uses('AppModel', 'Model');
/**
 * Encuesta Model
 *
 * @property Estudiante $Estudiante
 * @property Pregunta $Pregunta
 */
class Encuesta extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'respuesta';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Estudiante' => array(
			'className' => 'Estudiante',
			'foreignKey' => 'estudiante_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Pregunta' => array(
			'className' => 'Pregunta',
			'foreignKey' => 'pregunta_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $validate = array(
		'respuesta' => array(
			'required' => array(
				'rule' => 'validarTipo',
				'allowEmpty' => true,
				'message' => 'La respuesta es invalida'
			)
		)
	);

	public function validarTipo($check) {
		$encuesta = $this->findById($this->id);
		$respuesta = array_values($check)[0];
		$valores = explode(',', $encuesta['Pregunta']['valores']);

		$tipo = $encuesta['Pregunta']['tipo'];
		switch ($tipo) {
			case 'number':		// Numeros decimales con signo.
				return preg_match('/^[+-]?[0-9]+(\.[0-9]+)?$/', $respuesta);
			case 'select':		// Misma validación que para 'radio'.
			case 'radio':			// Enteros positivos menores a la cantidad de respuestas posibles.
				return (ctype_digit($respuesta)) && (intval($respuesta) < count($valores));
			case 'checkbox':	// Vector cuyos elementos sean enteros positivos menores a la cantidad de respuestas posibles.
				$checkboxs = explode(',', $respuesta);
				foreach ($checkboxs as $checkbox) {
					if (!ctype_digit($checkbox) || (intval($checkbox) >= count($valores))) {
						return false;
					}
				}

				// Verifico que no existan valores repetidos en la respuesta.
				return array_unique($checkboxs) === $checkboxs;
			case 'text':		// Cualquier valor.
				return true;
		}

		return false;
	}

	public function crearEncuesta($estudiante_id) {
		$preguntas = $this->Pregunta->find('list', array(
			'conditions' => array('Pregunta.activo =' => '1')
		));

		foreach ($preguntas as $pregunta) {
			$this->create();
			$data = array('estudiante_id' => $estudiante_id, 'pregunta_id' => $pregunta);
			$this->save($data);
		}

		return true;
	}

	public function eliminarEncuesta($estudiante_id) {
		$this->deleteAll(array('estudiante_id =' => $estudiante_id));
		return true;
	}

	public function regenerarEncuesta($estudiante_id) {
		$this->eliminarEncuesta($estudiante_id);
		$this->crearEncuesta($estudiante_id);

		return true;
	}
}
