<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
	/**
	 *  Permite que se muestre el nombre del tutor en 'Estudiante'.
	 */
	public $displayField = 'username';

	public $validate = array(
		'username' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'required' => true,
				'message' => 'El nombre de usuario no puede estar vacío'
			),
			'noWhiteSpace' => array(
				'rule' => array('custom', '/^\S*\z/'),
				'message' => 'El nombre de usuario no puede tener espacios'
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'El nombre de usuario debe ser único'
			),
			'maxLength' => array(
				'rule' => array('maxLength', 50),
				'message' => 'El nombre de usuario puede tener como máximo 50 caracteres'
			)
		),
		'password' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'required' => true,
				'message' => 'La contraseña no puede estar vacía'
			),
			'minLength' => array(
				'rule' => array('minLength', 6),
				'message' => 'La contraseña debe tener como mínimo 6 caracteres'
			)
		),
		'role' => array(
			'valid' => array(
				'rule' => array('inList', array('admin', 'tutor' ,'administrativo')),
				'required' => 'create',
				'message' => 'El rol es inválido'
			)
		)
	);

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
				$this->data[$this->alias]['password']
			);
		}

		return true;
	}
}
