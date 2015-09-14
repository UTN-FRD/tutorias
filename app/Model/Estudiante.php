<?php
App::uses('AppModel', 'Model');

/**
 * Estudiante Model
 *
 * @property Tutor $Tutor
 * @property Encuesta $Encuesta
 */
class Estudiante extends AppModel
{
    public $validate = array(
        'legajo' => array(
            'mayorCero' => array(
                'rule' => array('comparison', '>', 0),
                'required' => true,
                'message' => 'El número de legajo debe ser mayor a cero'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'El número de legajo debe ser único'
            )
        ),
        'nombre' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'El nombre no puede estar vacio'
            )
        ),
        'carrera' => array(
            'required' => array(
                'rule' => array('inList', array(
                    'Ingeniería en Sistemas',
                    'Ingeniería Mecanica',
                    'Ingeniería Electrica',
                    'Ingeniería Química'
                )),
                'required' => true,
                'message' => 'La carrera es invalida'
            )
        ),
        'user_id' => array(
            'required' => array(
                'rule' => 'validarUser',
                'allowEmpty' => true,
                'message' => 'El tutor es invalido'
            )
        )
    );

    public function validarUser($check) {
        $usuarios = $this->User->find('list', array(
            'fields' => array('User.username', 'User.id'),
            'conditions' => array('User.role =' => 'tutor')
        ));
        $respuesta = array_values($check)[0];

        return in_array($respuesta, $usuarios);
    }


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

    public function isOwnedBy($estudiante, $user)
    {
        return $this->field('id', array('id' => $estudiante, 'user_id' => $user)) !== false;
    }
}
