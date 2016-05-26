<?php
App::uses('AppController', 'Controller');

class EncuestasController extends AppController {
	public function index($id = null) {
		$this->Encuesta->Estudiante->recursive = 2;

		$this->Encuesta->Estudiante->id = $id;
		if (!$this->Encuesta->Estudiante->exists()) {
			throw new NotFoundException(__('Estudiante invalido'));
		}

		$estudiante = $this->Encuesta->Estudiante->read();
		$encuestas = $this->Encuesta->findAllByEstudiante_id($id, array(), 'orden');
		$this->set(array(
			'estudiante' => $estudiante['Estudiante'],
			'encuestas'  => $encuestas
		));
	}

	public function regenerate($id = null) {
		$this->request->allowMethod('post', 'put');

		$this->Encuesta->Estudiante->id = $id;
		if (!$this->Encuesta->Estudiante->exists()) {
			throw new NotFoundException(__('Estudiante invalido'));
		}

		$estudiante = $this->Encuesta->Estudiante->read();
		$this->Encuesta->regenerarEncuesta($estudiante['Estudiante']);

		return $this->redirect(array('action' => 'index', $id));
	}

	public function save() {
		$this->request->allowMethod('post', 'put');

		$this->layout = 'ajax';
		$this->autoRender = false;

		$this->Encuesta->id = $this->data['encuestaId'];

		if (!$this->Encuesta->exists()) {
			throw new NotFoundException(__('Encuesta invalida'));
		}

		$encuesta = $this->Encuesta->read();
		if ($encuesta['Pregunta']['tipo'] == 'Check Box' && !empty($this->data['respuesta'])) {
			$this->Encuesta->set(array(
				'respuesta' => implode(",", $this->data['respuesta'])
			));
		} else {
			$this->Encuesta->set(array(
				'respuesta' => $this->data['respuesta']
			));
		}

		if (!$this->Encuesta->save()) {
			$this->response->statusCode(400);
		}
	}

	public function isAuthorized($user) {
		switch ($this->action) {
			case 'index':
				if (!empty($this->request->params['pass'])) {
					$estudiante = $this->request->params['pass'][0];

					if ($this->Encuesta->Estudiante->isOwnedBy($estudiante, $user['id'])) {
						return true;
					}
				}

				break;
			case 'save':
				$this->Encuesta->recursive = 2;

				$this->Encuesta->id = $this->request->data['encuestaId'];
				if ($this->Encuesta->exists()) {
					$encuesta = $this->Encuesta->read();
					$tutor = $encuesta['Estudiante']['User'];

					if (isset($tutor['id']) && ($tutor['id'] == $user['id'])) {
						return true;
					}
				}

				break;
		}

		return parent::isAuthorized($user);
	}
}
