<?php
App::uses('AppModel', 'Model');

class Pregunta extends AppModel {
	public $hasMany = array(
		'Encuesta' => array(
			'className'  => 'Encuesta',
			'foreignKey' => 'pregunta_id',
			'dependent'  => false
		)
	);

	public $validate = array(
		'orden' => array(
			'range' => array(
				'rule'     => array('range', -1, 1000000000),
				'required' => true,
				'message'  => 'El orden debe ser un número entre 0 y 999.999.999'
			),
		),
		'pregunta' => array(
			'notBlank' => array(
				'rule'     => 'notBlank',
				'required' => true,
				'message'  => 'La pregunta no puede estar vacía'
			),
			'maxLength' => array(
				'rule'    => array('maxLength', 75),
				'message' => 'La pregunta puede tener como máximo 75 caracteres'
			)
		),
		'tipo' => array(
			'valid' => array(
				'rule'     => array('inList', array(
					'Texto',
					'Numérico',
					'Menú Desplegable',
					'Check Box',
					'Radio Button'
				)),
				'required' => true,
				'message'  => 'El tipo de pregunta es inválido'
			)
		),
		'activo' => array(
			'boolean' => array(
				'rule'    => 'boolean',
				'message' => 'El valor de activo debe ser booleano'
			)
		)
	);
}
