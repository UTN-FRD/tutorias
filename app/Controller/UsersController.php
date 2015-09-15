<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('logout');
    }

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('El usuario ha sido creado correctamente.', 'success');
                return $this->redirect(array('action' => 'index'));
            }

            $this->Session->setFlash('No se ha podido crear el usuario. Por favor, intente nuevamente.', 'error');
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuario invalido'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('El usuario ha sido actualizado correctamente.', 'success');
                return $this->redirect(array('action' => 'index'));
            }

            $this->Session->setFlash('No se ha podido actualizar el usuario. Por favor, intente nuevamente.', 'error');
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
            $this->Session->setFlash('El usuario ha sido eliminado correctamente.', 'success');
        } else {
            $this->Session->setFlash('No se ha podido eliminar el usuario. Por favor, intente nuevamente.', 'error');
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
                return $this->redirect($this->Auth->redirectUrl("/"));
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
