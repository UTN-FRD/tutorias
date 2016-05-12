<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
    public $displayField = 'username';

    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => 'notBlank',
                'required' => true,
                'message' => 'El nombre de usuario no puede estar vacio'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'El nombre de usuario debe ser único'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'required' => true,
                'message' => 'La contraseña no puede estar vacia'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'tutor')),
                'required' => true,
                'on' => 'create',
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
