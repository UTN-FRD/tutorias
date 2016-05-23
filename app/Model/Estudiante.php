<?php
App::uses('AppModel', 'Model');

class Estudiante extends AppModel {
	public $belongsTo = array(
		'User' => array(
			'className'  => 'User',
			'foreignKey' => 'user_id',
			'conditions' => array('User.role' => 'tutor')
		)
	);

	public $hasMany = array(
		'Encuesta' => array(
			'className'  => 'Encuesta',
			'foreignKey' => 'estudiante_id',
			'dependent'  => true
		)
	);

	public $validate = array(
		'legajo' => array(
			'range' => array(
				'rule'     => array('range', -1, 1000000000),
				'required' => true,
				'message'  => 'El número de legajo debe estar entre 0 y 999.999.999'
			),
			'isUnique' => array(
				'rule'    => 'isUnique',
				'message' => 'El número de legajo debe ser único'
			)
		),
		'nombre' => array(
			'notBlank' => array(
				'rule'     => 'notBlank',
				'required' => true,
				'message'  => 'El nombre no puede estar vacío'
			),
			'maxLength' => array(
				'rule'    => array('maxLength', 50),
				'message' => 'El nombre puede tener como máximo 50 caracteres'
			)
		),
		'carrera' => array(
			'valid' => array(
				'rule'     => array('inList', array(
					'Ingeniería en Sistemas',
					'Ingeniería Mecánica',
					'Ingeniería Eléctrica',
					'Ingeniería Química'
				)),
				'required' => true,
				'message'  => 'La carrera es invalida'
			)
		)
	);

	/*
	 * Devuelve si $estudiante tiene como tutor a $tutor.
	 */
	public function isOwnedBy($estudiante = null, $tutor = null) {
		return !empty($this->field('id', array('id' => $estudiante, 'user_id' => $tutor)));
	}
}
