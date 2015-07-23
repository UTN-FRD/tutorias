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
		foreach($this->Pregunta->find('list', array(
			'conditions' => array('Pregunta.activo =' => '1')
		)) as $p ){ // aplicar filtro
			$this->create();
			$data = array('estudiante_id' => $estudiante_id, 'pregunta_id' => $p);
			$this->save($data);
		}
		return true;
	}



	public function regenerarEncuesta($estudiante_id) {
		foreach($this->Pregunta->find('list', array(
			'conditions' => array('Pregunta.activo =' => '1')
		)) as $p ){
			$this->delete();
		}
		$this->crearEncuesta($estudiante_id);
		return true;
 		}

}
