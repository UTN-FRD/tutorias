<?php
App::uses('AppModel', 'Model');
/**
 * Pregunta Model
 *
 * @property Encuesta $Encuesta
 */
class Pregunta extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Encuesta' => array(
			'className' => 'Encuesta',
			'foreignKey' => 'pregunta_id',
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

	public $validate = array(
		'orden' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'El orden no puede estar vacio'
			)
		),
		'pregunta' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'La pregunta no puede estar vacia'
			)
		)
	);

}
