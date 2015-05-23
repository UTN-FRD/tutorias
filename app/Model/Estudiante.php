<?php
App::uses('AppModel', 'Model');
/**
 * Estudiante Model
 *
 * @property Tutor $Tutor
 * @property Encuesta $Encuesta
 */
class Estudiante extends AppModel {
	public $validate = array(
		'legajo' => array(
			'mayorCero' => array(
				'rule' => array('comparison', '>', 0),
				'message' => 'El número de legajo debe ser mayor a cero'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'El número de legajo debe ser único'
			)
		),
		'nombre' => array(
			'alphaNumeric' => array(
				'rule' => 'alphaNumeric',
				'required' => true,
				'notEmpty' => false,
				'message' => 'El nombre no puede estar vacio'
			)
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
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

	public function isOwnedBy($estudiante, $user) {
		return $this->field('id', array('id' => $estudiante, 'user_id' => $user)) !== false;
	}
}
