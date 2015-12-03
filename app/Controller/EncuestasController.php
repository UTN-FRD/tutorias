<?php
App::uses('AppController', 'Controller');
/**
 * Encuestas Controller
 *
 * @property Encuesta $Encuesta
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class EncuestasController extends AppController {
	public function index($id = null) {
		if (!$this->Encuesta->Estudiante->exists($id)) {
			throw new NotFoundException(__('Estudiante invalido'));
		}

		$this->set(array(
			'estudiante' => $this->Encuesta->Estudiante->findById($id)['Estudiante'],
			'encuestas' => $this->Encuesta->findAllByEstudiante_id($id, array(), 'orden')
		));
	}

	public function regenerate($id = null) {
		$this->request->allowMethod('post', 'put');

		if (!$this->Encuesta->Estudiante->exists($id)) {
			throw new NotFoundException(__('Estudiante invalido'));
		}

		$this->Encuesta->regenerarEncuesta($id);
		return $this->redirect(array('action' => 'index', $id));
	}


	public function save() {
		$this->request->allowMethod('post', 'put');

		$this->layout = 'ajax';
		$this->autoRender = false;

		$this->Encuesta->id = $this->data['encuestaId'];

		$tipo_pregunta = $this->Encuesta->findById($this->Encuesta->id)['Pregunta']['tipo'];
		if ($tipo_pregunta === 'checkbox' && !empty($this->data['respuesta'])) {
			$this->Encuesta->set(array(
				'respuesta' => implode(",", $this->data['respuesta'])
			));
		} else {
			$this->Encuesta->set(array(
				'respuesta' => $this->data['respuesta']
			));
		}

		if ($this->Encuesta->save()) {
			return "success";
		} else {
			return "error";
		}
	}

	public function isAuthorized($user) {
		if (in_array($this->action, array('index', 'save'))) {
			if ($this->action == 'index') {
				$estudianteId = (int) $this->request->params['pass'][0];
			} elseif ($this->action == 'save') {
				$estudianteId = $this->Encuesta->findById($this->request->data['encuestaId'])['Encuesta']['estudiante_id'];
			}

			if ($this->Encuesta->Estudiante->isOwnedBy($estudianteId, $user['id'])) {
				return true;
			}
		}

		return parent::isAuthorized($user);
	}
}
