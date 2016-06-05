<?php
App::uses('AppModel', 'Model');

class Estudiante extends AppModel {
	public $belongsTo = array(
		'User' => array(
			'className'  => 'User',
			'conditions' => array('User.role' => 'tutor')
		),
		'Carrera' => array(
			'className'  => 'Carrera'
		)
	);

	public $hasMany = array(
		'Encuesta' => array(
			'className'  => 'Encuesta',
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
		'carrera_id' => array(
			'valid' => array(
				'rule'     => 'validarCarrera',
				'required' => true,
				'message'  => 'La carrera es invalida'
			)
		)
	);

	public function validarCarrera($check) {
		$carrera = array_values($check)[0];
		return ($this->Carrera->exists($carrera) && $carrera < 128);
	}

	/*
	 * Devuelve si $estudiante tiene como tutor a $tutor.
	 */
	public function isOwnedBy($estudiante = null, $tutor = null) {
		return !empty($this->field('id', array('id' => $estudiante, 'user_id' => $tutor)));
	}
}
