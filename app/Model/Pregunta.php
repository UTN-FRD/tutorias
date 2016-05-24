<?php
App::uses('AppModel', 'Model');

class Pregunta extends AppModel {
	const TIPO_TEXTO = 0;
	const TIPO_NUMERICO = 1;
	const TIPO_MENU = 2;
	const TIPO_RADIO = 3;
	const TIPO_CHECKBOX = 4;

	public static function tipos($value = null) {
		$options = array(
			self::TIPO_TEXTO    => __('Texto'),
			self::TIPO_NUMERICO => __('Numérico'),
			self::TIPO_MENU     => __('Menú Desplegable'),
			self::TIPO_RADIO    => __('Radio Button'),
			self::TIPO_CHECKBOX => __('Check Box')
		);

		return parent::enum($value, $options);
	}

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
				'rule'     => 'validarTipo',
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

	public function validarTipo($check) {
		$tipo = array_values($check)[0];
		return array_key_exists($tipo, self::tipos());
	}
}
