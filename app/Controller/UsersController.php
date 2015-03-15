<?php
App::uses('AppController','Controller');

class UsersController extends AppController {
    public $components = array(
        'Session',
        'Auth'=>array(
            'loginRedirect' => array('controller' => 'Estudiantes', 'action' => 'index'),
        )
    );
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add','logout');
    }

    public function index() {
        $this->User->recursive = 0;
        $this->set('users',$this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user',$this->User->read(null,$id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The user could not be saved.Please, try again.')
            );
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        } else {
            $this->request->date = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        // prior to 2.5 use 
        // $this->request->onlyAllow('post');
        
        $this->request->allowMethod('post');
        
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Invalid user'));
        return $this->redirect(array('action' => 'index'));
    }

public function login() {
    if ($this->request->is('post')) {
        if ($this->Auth->login()) {
            return $this->redirect($this->Auth->redirectUrl());
        }
        $this->Session->setFlash(__('Invalid username or password, try again'));
    }

}

public function logout() {
    return $this->redirect($this->Auth->logout());
}
}