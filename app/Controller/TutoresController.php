<?php
App::uses('AppController', 'Controller');
/**
 * Tutores Controller
 *
 * @property Tutore $Tutore
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TutoresController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Tutore->recursive = 0;
		$this->set('tutores', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Tutore->exists($id)) {
			throw new NotFoundException(__('Tutor inválido'));
		}
		$options = array('conditions' => array('Tutore.' . $this->Tutore->primaryKey => $id));
		$this->set('tutore', $this->Tutore->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Tutore->create();
			if ($this->Tutore->save($this->request->data)) {
				$this->Session->setFlash(__('El tutor ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El tutor no ha podido ser guardado. Por favor, intente nuevamente.'));
			}
		}
		
		$this->set('carreras', 
			array(
				    'Ingeniería en Sistemas' => 'Ingeniería en Sistemas',
				    'Ingeniería Mecanica' => 'Ingeniería Mecanica',
				    'Ingeniería Electrica' => 'Ingeniería Electrica',
				    'Ingeniería Química' => 'Ingeniería Química'
				)
        	);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	function edit($id = null) {
	    if (!$id) {
	        throw new NotFoundException(__('Tutor inválido'));
	    }

	    $tutor = $this->Tutore->findById($id);
	    if (!$tutor) {
	        throw new NotFoundException(__('Tutor inválido'));
	    }

	    if ($this->request->is(array('tutor', 'put'))) {
	        if ($this->Tutore->save($this->request->data)) {
	            $this->Session->setFlash(__('El tutor ha sido actualizado.'));
	            return $this->redirect(array('action' => 'index'));
	        }
	        $this->Session->setFlash(__('No se puede actualizar el tutor.'));
	    }

	    if (!$this->request->data) {
	        $this->request->data = $tutor;
	    }



		$this->set('carreras', 
			array(
				    'Ingeniería en Sistemas' => 'Ingeniería en Sistemas',
				    'Ingeniería Mecanica' => 'Ingeniería Mecanica',
				    'Ingeniería Electrica' => 'Ingeniería Electrica',
				    'Ingeniería Química' => 'Ingeniería Química'
				)
        	);
    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Tutore->id = $id;
		if (!$this->Tutore->exists()) {
			throw new NotFoundException(__('Tutor inválido'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Tutore->delete()) {
			$this->Session->setFlash(__('El tutor ha sido borrado.'));
		} else {
			$this->Session->setFlash(__('El tutor no ha podido ser borrado. Por favor, intente nuevamente.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
