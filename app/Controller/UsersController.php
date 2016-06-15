<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
	public $paginate = [
		'limit' => 25
	];

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
				$this->Flash->success('El usuario ha sido creado correctamente.');
				return $this->redirect(array('action' => 'index'));
			}

			$this->Flash->error('No se ha podido crear el usuario. Por favor, intente nuevamente.');
		}
	}

	public function edit($id = null) {
		if ($id == null) {
			$id = $this->Auth->user('id');
		}

		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException('Usuario inválido');
		}

		if ($this->request->is(array('post', 'put'))) {
			unset($this->request->data['User']['role']);

			if ($id == $this->Auth->user('id')) {
				if ($this->User->save($this->request->data)) {
					// Actualiza el nombre de usuario de la navbar.
					$this->Auth->login();

					$this->Flash->success('Tu usuario ha sido actualizado correctamente.');
					return $this->redirect(array('action' => 'index'));
				}

				$this->Flash->error('No se ha podido actualizar tu usuario. Por favor, intente nuevamente.');
			} else  {
				if ($this->User->save($this->request->data)) {
					$this->Flash->success('El usuario ha sido actualizado correctamente.');
					return $this->redirect(array('action' => 'index'));
				}

				$this->Flash->error('No se ha podido actualizar el usuario. Por favor, intente nuevamente.');
			}
		}

		$this->request->data = $this->User->read();
		unset($this->request->data['User']['password']);
	}

	public function delete($id = null) {
		$this->request->allowMethod('post');

		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException('Usuario inválido');
		}

		if ($this->User->id == AuthComponent::user('id')) {
			throw new ForbiddenException;
		}

		if ($this->User->delete()) {
			$this->Flash->success('El usuario ha sido eliminado correctamente.');
		} else {
			$this->Flash->error('No se ha podido eliminar el usuario. Por favor, intente nuevamente.');
		}

		return $this->redirect(array('action' => 'index'));
	}

	/**
	 * Devuelve si un nombre de usuario esta disponible. Si se especifica
	 * un usuario se considerara valido su propio nombre de usuario.
	 */
	public function check_username($id = null) {
		$this->request->allowMethod('post');
		$this->layout = 'ajax';
		$this->autoRender = false;

		$user = $this->User->findByUsername($this->data['User']['username']);
		if (empty($user) || ($user['User']['id'] == $id)) {
			echo 'true';
		} else {
			echo 'false';
		}
	}

	public function login() {
		if ($this->Auth->loggedIn()) {
			return $this->redirect($this->Auth->redirectUrl());
		}

		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirectUrl());
			}

			$this->Flash->error('Nombre de usuario o contraseña inválido. Por favor intente nuevamente o comuníquese con SAE.');
		}
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}

	public function isAuthorized($user) {
		switch ($this->action) {
			case 'check_username':
				return true;
				break;
			case 'edit':
				if (empty($this->request->params['pass'])) {
					return true;
				}
				break;
		}

		return parent::isAuthorized($user);
	}
}
