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
		$this->Estudiante->recursive = 0;
		if ($this->Auth->user('role') == 'admin' || $this->Auth->user('role') == 'administrativo') {
			$this->set('estudiantes', $this->paginate('Estudiante'));
		} else {
			$this->set('estudiantes', $this->paginate('Estudiante', array(
				'Estudiante.user_id' => $this->Auth->user('id')
			)));
		}
	}

	public function add() {
		$this->set(array(
			'users' => $this->Estudiante->User->find('list', array(
				'conditions' => array('User.role' => 'tutor')
			)),
			'carreras' => $this->Estudiante->Carrera->find('list', array(
				'conditions' => array('Carrera.id <' => '128')
			))
		));

		if ($this->request->is('post')) {
			$this->Estudiante->create();

			if ($this->Estudiante->save($this->request->data)) {
				$this->Estudiante->Encuesta->crear($this->Estudiante->id);
				$this->Flash->success('El '.(Plataforma::esTutorias() ? 'estudiante' : 'graduado').' ha sido creado correctamente.');
				if($this->Auth->user('role')==='administrativo') {
				    return $this->redirect(array('controller' => 'encuestas', 'action' => 'index', $this->Estudiante->id)); }
				else {
				    return $this->redirect(array('action' => 'index')); }

			}

			$this->Flash->error('No se ha podido crear el estudiante. Por favor, intente nuevamente.');
		}
	}

	public function edit($id = null) {
		$this->Estudiante->id = $id;
		if (!$this->Estudiante->exists()) {
			throw new NotFoundException('Estudiante inválido');
		}

		$this->set(array(
			'users' => $this->Estudiante->User->find('list', array(
				'conditions' => array('User.role' => 'tutor')
			)),
			'carreras' => $this->Estudiante->Carrera->find('list', array(
				'conditions' => array('Carrera.id <' => '128')
			))
		));

		if ($this->request->is(array('post', 'put'))) {
			if ($this->Estudiante->save($this->request->data)) {
				$this->Flash->success('El estudiante ha sido actualizado correctamente.');
				return $this->redirect(array('action' => 'index'));
			}

			$this->Flash->error('No se ha podido actualizar el estudiante. Por favor, intente nuevamente.');
		}

		$this->request->data = $this->Estudiante->read();
	}

	public function delete($id = null) {
		$this->request->allowMethod('post');

		$this->Estudiante->id = $id;
		if (!$this->Estudiante->exists()) {
			throw new NotFoundException('Estudiante inválido');
		}

		if ($this->Estudiante->delete()) {
			$this->Flash->success('El estudiante se ha eliminado correctamente.');
		} else {
			$this->Flash->error('No se ha podido eliminar el estudiante. Por favor, intente nuevamente.');
		}

		return $this->redirect(array('action' => 'index'));
	}

	/**
	 * Devuelve si un legajo está disponible. Si se especifica un estudiante, se considerará
	 * válido su propio legajo.
	 */
	public function check_legajo($id = null) {
		$this->request->allowMethod('post');
		$this->layout = 'ajax';
		$this->autoRender = false;

		$estudiante = $this->Estudiante->findByLegajo($this->data['Estudiante']['legajo']);
		if (empty($estudiante) || ($estudiante['Estudiante']['id'] == $id)) {
			echo 'true';
		} else {
			echo 'false';
		}
	}

	public function isAuthorized($user) {
		switch ($this->action) {
			case 'index':
			case 'check_legajo':
				return true;
				break;

			case 'edit':
				// Evito que un tutor pueda modificar el tutor de un estudiante propio.
				if ($user['role'] == 'tutor' && isset($this->request->data['Estudiante']['user_id'])) {
					return false;
				}

				if (!empty($this->request->params['pass'])) {
					$estudianteId = $this->request->params['pass'][0];
					if ($this->Estudiante->isOwnedBy($estudianteId, $user['id'])) {
						return true;
					}
				}

				break;
		}

		return parent::isAuthorized($user);
	}
}
