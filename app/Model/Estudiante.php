<?php
App::uses('AppModel', 'Model');

class Estudiante extends AppModel {
	const CARRERA_SISTEMAS = 0;
	const CARRERA_MECANICA = 1;
	const CARRERA_ELECTRICA = 2;
	const CARRERA_QUIMICA = 3;

	public static function carreras($value = null) {
		$options = array(
			self::CARRERA_SISTEMAS  => __('Ingeniería en Sistemas'),
			self::CARRERA_MECANICA  => __('Ingeniería Mecánica'),
			self::CARRERA_ELECTRICA => __('Ingeniería Eléctrica'),
			self::CARRERA_QUIMICA   => __('Ingeniería Química')
		);

		return parent::enum($value, $options);
	}

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
				'rule'     => 'validarCarrera',
				'required' => true,
				'message'  => 'La carrera es invalida'
			)
		)
	);

	public function validarCarrera($check) {
		$carrera = array_values($check)[0];
		return array_key_exists($carrera, self::carreras());
	}

	/*
	 * Devuelve si $estudiante tiene como tutor a $tutor.
	 */
	public function isOwnedBy($estudiante = null, $tutor = null) {
		return !empty($this->field('id', array('id' => $estudiante, 'user_id' => $tutor)));
	}
}
