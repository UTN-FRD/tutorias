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
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Pregunta->recursive = 0;
		$this->set('preguntas', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Pregunta->exists($id)) {
			throw new NotFoundException(__('Invalid pregunta'));
		}
		$options = array('conditions' => array('Pregunta.' . $this->Pregunta->primaryKey => $id));
		$this->set('pregunta', $this->Pregunta->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Pregunta->create();
			if ($this->Pregunta->save($this->request->data)) {
				$this->Session->setFlash(__('The pregunta has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pregunta could not be saved. Please, try again.'));
			}
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
		if (!$this->Pregunta->exists($id)) {
			throw new NotFoundException(__('Invalid pregunta'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Pregunta->save($this->request->data)) {
				$this->Session->setFlash(__('The pregunta has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pregunta could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Pregunta.' . $this->Pregunta->primaryKey => $id));
			$this->request->data = $this->Pregunta->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Pregunta->id = $id;
		if (!$this->Pregunta->exists()) {
			throw new NotFoundException(__('Invalid pregunta'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Pregunta->delete()) {
			$this->Session->setFlash(__('The pregunta has been deleted.'));
		} else {
			$this->Session->setFlash(__('The pregunta could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
