<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
    public $displayField = 'username';

    public $validate = array(
        'username' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Por favor ingrese un nombre de usuario'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'El nombre de usuario debe ser único'
            )
        ),
        'password' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Por favor ingrese una contraseña'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'tutor')),
                'required' => true,
                'message' => 'El rol es invalido'
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
