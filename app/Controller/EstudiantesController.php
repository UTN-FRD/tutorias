<?php
App::uses('AppController', 'Controller');

class EstudiantesController extends AppController {
    public $paginate = [
        'limit' => 25,
        'order' => [
            'Estudiante.nombre' => 'asc'
        ]
    ];

    public function index() {
        if ($this->Auth->user('role') == 'admin') {
            $this->set('estudiantes', $this->paginate('Estudiante'));
        } else {
            $this->set('estudiantes', $this->paginate('Estudiante',
                array('Estudiante.user_id' => $this->Auth->user('id') )));
        }
    }

    public function add(){
        $this->set('users', $this->Estudiante->User->find('list', array('conditions' => array('User.role =' => 'tutor'))));

        $this->set('carreras', 
            array(
                'Ingeniería en Sistemas' => 'Ingeniería en Sistemas',
                'Ingeniería Mecanica' => 'Ingeniería Mecanica',
                'Ingeniería Electrica' => 'Ingeniería Electrica',
                'Ingeniería Química' => 'Ingeniería Química'
            )
        );

        if ($this->request->is(array('post'))) {
            $this->Estudiante->create($this->request->data);

            if ($this->Estudiante->save()){
                $this->Estudiante->Encuesta->crearEncuesta($this->Estudiante->id);
                return $this->redirect(array('controller' => '/estudiantes', 'action' => 'index'));
            }

            $this->Session->setFlash(__('No se ha podido actualizar el estudiante.'));
        }
    }

    public function edit($id = null) {
        $this->set('users', $this->Estudiante->User->find('list', array('conditions' => array('User.role =' => 'tutor'))));

        $this->set('carreras', 
            array(
                'Ingeniería en Sistemas' => 'Ingeniería en Sistemas',
                'Ingeniería Mecanica' => 'Ingeniería Mecanica',
                'Ingeniería Electrica' => 'Ingeniería Electrica',
                'Ingeniería Química' => 'Ingeniería Química'
            )
        );

        if (!$id) {
            throw new NotFoundException(__('Tutor inválido'));
        }

        $estudiante = $this->Estudiante->findById($id);
        if (!$estudiante) {
            throw new NotFoundException(__('Estudiante inválido'));
        }

        if ($this->request->is(array('put'))) {
            $this->Estudiante->id = $id;
            if ($this->Estudiante->save($this->request->data)) {
                $this->Session->setFlash(__('El estudiante ha sido actualizado'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('No se puede actualizar estudiante.'));
        }

        if (!$this->request->data) {
            $this->request->data = $estudiante;
        }
    }

    public function delete($id = null) {        
        $this->request->allowMethod('post');
        
        $this->Estudiante->id = $id;
        if (!$this->Estudiante->exists()) {
            throw new NotFoundException(__('Estudiante invalido'));
        }

        if ($this->Estudiante->delete()) {
            $this->Session->setFlash(__('Estudiante eliminado'));
        } else {
            $this->Session->setFlash(__('Estudiante invalido'));
        }
        
        return $this->redirect(array('controller' => '/estudiantes', 'action' => 'index'));
    }

    public function isAuthorized($user) {
        if (in_array($this->action, array('index'))) {
            return true;
        }

        if (in_array($this->action, array('edit'))) {
            $estudianteId = (int) $this->request->params['pass'][0];
            if ($this->Estudiante->isOwnedBy($estudianteId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }
}
