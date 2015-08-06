<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
    public function beforeFilter() {
        parent::beforeFilter();
        // sacar el add luego.
        $this->Auth->allow('logout','add');
    }

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuario invalido'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('El usuario ha sido creado'));
                return $this->redirect(array('action' => 'index'));
            }

            $this->Session->setFlash(
                __('El usuario no puede ser guardado, intente nuevamente.')
            );
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuario invalido'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('El usuario ha sido guardado'));
                return $this->redirect(array('action' => 'index'));
            }

            $this->Session->setFlash(
                __('El usuario no puede ser guardado, intente nuevamente.')
            );
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuario invalido'));
        }

        if ($this->User->delete()) {
            $this->Session->setFlash(__('Usuario eliminado'));
        } else {
            $this->Session->setFlash(__('Usuario invalido'));
        }

        return $this->redirect(array('action' => 'index'));
    }

    public function login() {
        // If already logged-in, redirect
        if($this->Auth->loggedIn()){
            return $this->redirect($this->Auth->redirectUrl());
        }

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Session->setFlash('Nombre de usuario o contraseña invalido. Por favor intente nuevamente o comuniquese con SAE.', 'error');
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function isAuthorized($user) {
        if (in_array($this->action, array('edit'))) {
            $userId = (int) $this->request->params['pass'][0];
            if ($userId == $user['id']) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }
}
