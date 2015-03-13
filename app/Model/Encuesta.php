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

	public function crearEncuesta($estudiante_id) {
		foreach($this->Pregunta->find('list') as $p ){
			$this->create();
			$data = array('estudiante_id' => $estudiante_id, 'pregunta_id' => $p);
			$this->save($data);
		}

		return true;
	}
}
