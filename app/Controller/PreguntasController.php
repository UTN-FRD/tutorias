<?php
App::uses('AppController', 'Controller');
/**
 * Preguntas Controller
 *
 * @property Pregunta $Pregunta
 * @property PaginatorComponent $Paginator
 */
class PreguntasController extends AppController {
/**
 * index method
 *
 * @return void
 */

	public $paginate = [
		'limit' => 25,
		'order' => [
			'Pregunta.orden' => 'asc'
		]
	];

	public function index() {
		$this->Pregunta->recursive = 0;
		$this->set('preguntas', $this->paginate());
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('tipos', array(
			'text' => 'Texto',
			'number' => 'Numerico',
			'select' => 'Menu Desplegable',
			'checkbox' => 'Check Box',
			'radio' => 'Radio Button'
		));

		if ($this->request->is('post')) {
			$this->Pregunta->create($this->request->data);

			if ($this->Pregunta->save()) {
				$this->Session->setFlash('La pregunta ha sido creada correctamente.', 'success');
				return $this->redirect(array('action' => 'index'));
			}

			$this->Session->setFlash('No se ha podido crear la pregunta. Por favor, intente nuevamente.', 'error');
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Pregunta->id = $id;
		if (!$this->Pregunta->exists()) {
			throw new NotFoundException(__('Pregunta inválida'));
		}

		$this->set('tipos', array(
			'text' => 'Texto',
			'number' => 'Numerico',
			'select' => 'Menu Desplegable',
			'checkbox' => 'Check Box',
			'radio' => 'Radio Button'
		));

		if ($this->request->is(array('post', 'put'))) {
			if ($this->Pregunta->save($this->request->data)) {
				$this->Session->setFlash('La pregunta ha sido actualizada correctamente.', 'success');
				return $this->redirect(array('action' => 'index'));
			}

			$this->Session->setFlash('No se ha podido actualizar la pregunta. Por favor, intente nuevamente.', 'error');
		}

		if (!$this->request->data) {
			$this->request->data = $this->Pregunta->findById($id);
		}
	}

	public function activate($id = null, $value = 0) {
		$this->request->allowMethod('post', 'put');

		$this->Pregunta->id = $id;
		if (!$this->Pregunta->exists()) {
			throw new NotFoundException(__('Pregunta inválida'));
		}

		$this->autoRender = false;
		$estado = (int)$this->Pregunta->field("activo");
		if ($estado != (int)$value) {
			$this->Pregunta->saveField("activo", $value);
		}
	}
}
