<?php
App::uses('AppModel', 'Model');
/**
 * Estudiante Model
 *
 * @property Tutor $Tutor
 * @property Encuesta $Encuesta
 */
class Estudiante extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Tutore' => array(
			'className' => 'Tutore',
			'foreignKey' => 'tutor_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Encuesta' => array(
			'className' => 'Encuesta',
			'foreignKey' => 'estudiante_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
