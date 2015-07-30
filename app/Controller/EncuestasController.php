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
	function index($id = null){
		$conditions = array(
			'order' => 'orden', //cambiar por orden
			'conditions' => ['Estudiante.id' => $id]
		);
		$this->set('encuestas', $this->Encuesta->find('all', $conditions));
	}

	public function regenerate($id = null) {
		$this->Encuesta->regenerarEncuesta($id);
		return $this->redirect(array('action' => 'index', $id));
	}


	function save($id = null) {
		$this->layout = 'ajax';
		$this->autoRender = false;

		if (!$id) {
	        throw new NotFoundException(__('Estudiante Invalido'));
	    }

		if ($this->request->is(array('post', 'put'))) {
			$this->Encuesta->id = $this->data['encuestaId'];
			$this->Encuesta->set(array(
			    'respuesta' => $this->data['respuesta']
			));

			$this->Encuesta->save();

			echo "success";
		} else {
			echo "error";
		}
	}

	public function isAuthorized($user) {
        // Admin can access every action
        return true;
    }
}
