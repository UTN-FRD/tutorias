<?php
App::uses('AppModel', 'Model');

class Pregunta extends AppModel {
	const TIPO_TEXTO = 0;
	const TIPO_NUMERICO = 1;
	const TIPO_MENU = 2;
	const TIPO_RADIO = 3;
	const TIPO_CHECKBOX = 4;
	const TIPO_FECHA = 5;

	public static function tipos($value = null) {
		$options = array(
			self::TIPO_TEXTO    => 'Texto',
			self::TIPO_NUMERICO => 'Numérico',
			self::TIPO_MENU     => 'Menú Desplegable',
			self::TIPO_RADIO    => 'Radio Button',
			self::TIPO_CHECKBOX => 'Check Box',
			self::TIPO_FECHA    => 'Fecha'
		);

		return parent::enum($value, $options);
	}

	public $belongsTo = array(
		'Carrera' => array(
			'className'  => 'Carrera'
		)
	);

	public $hasMany = array(
		'Encuesta' => array(
			'className'  => 'Encuesta',
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
				'rule'    => array('maxLength', 255),
				'message' => 'La pregunta puede tener como máximo 255 caracteres'
			)
		),
		'tipo' => array(
			'valid' => array(
				'rule'     => 'validarTipo',
				'required' => true,
				'message'  => 'El tipo de pregunta es inválido'
			)
		),
		'valores' => array(
			'maximum' => array(
				'rule'     => 'validarOpciones',
				'required' => true,
				'message'  => 'La cantidad máxima de opciones es 20'
			)
		),
		'activo' => array(
			'boolean' => array(
				'rule'    => 'boolean',
				'message' => 'El valor de activo debe ser booleano'
			)
		),
		'ayuda' => array(
			'maxLength' => array(
				'rule'    => array('maxLength', 65535),
				'message' => 'La ayuda puede tener como máximo 65535 caracteres'
			)
		),
		'carrera_id' => array(
			'valid' => array(
				'rule'     => 'validarCarrera',
				'required' => true,
				'message'  => 'La carrera es inválida'
			)
		)
	);

	public function validarCarrera($check) {
		$carrera = array_values($check)[0];
		return ($this->Carrera->exists($carrera));
	}

	public function validarTipo($check) {
		$tipo = array_values($check)[0];
		return array_key_exists($tipo, self::tipos());
	}

	public function validarOpciones($check) {
		$opciones = array_values($check)[0];
		return (count($opciones) <= 20);
	}

	public function beforeSave($options = array()) {
		// Elimina las opciones vacias.
		foreach ($this->data['Pregunta']['valores'] as $key => $valor) {
			if (empty(trim($valor))) {
				unset($this->data['Pregunta']['valores'][$key]);
			}
		}

		if (!empty($this->data['Pregunta']['valores'])) {
			$this->data['Pregunta']['valores'] = implode(',', $this->data['Pregunta']['valores']);
		} else {
			$this->data['Pregunta']['valores'] = '';
		}

		return true;
	}
}
