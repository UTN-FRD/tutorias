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
				'rule' => 'notBlank',
				'required' => true,
				'message' => 'El orden no puede estar vacio'
			)
		),
		'pregunta' => array(
			'required' => array(
				'rule' => 'notBlank',
				'required' => true,
				'message' => 'La pregunta no puede estar vacia'
			)
		),
		'tipo' => array(
			'required' => array(
				'rule' => array('inList', array(
					'text',
					'number',
					'select',
					'checkbox',
					'radio'
				)),
				'required' => true,
				'message' => 'El tipo de pregunta es invalido'
			)
		)
	);
}
