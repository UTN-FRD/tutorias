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
		if (!$id) {
	        throw new NotFoundException(__('Estudiante Invalido'));
	    }

		if ($this->request->is(array('post', 'put'))) {
			$this->Encuesta->id = $this->data['encuestaId'];
			$this->Encuesta->set(array(
			    'respuesta' => $this->data['respuesta']
			));
			$this->Encuesta->save();
		}


		$conditions = array(
			'order' => 'orden', //cambiar por orden
			'conditions' => ['Estudiante.id' => $id]
		);

		$this->set('encuestas', $this->Encuesta->find('all', $conditions));

	}
}

