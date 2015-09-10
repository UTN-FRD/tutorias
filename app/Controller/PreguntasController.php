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
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Pregunta->exists($id)) {
			throw new NotFoundException(__('Pregunta inválida'));
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
		$this->set('tipos', array(
			'texto' => 'Texto',
			'number' => 'Numerico',
			'select' => 'Menu Desplegable',
			'checkbox' => 'Check Box',
			'radio' => 'Radio Button'
		));

		if ($this->request->is('post')) {
			$this->Pregunta->create($this->request->data);

			if ($this->Pregunta->save()) {
				$this->Session->setFlash(__('La pregunta ha sido guardada.'));
				return $this->redirect(array('action' => 'index'));
			}

			$this->Session->setFlash(__('La pregunta no ha podido ser guardada. Por favor, intente nuevamente.'));
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

		if (!$this->Pregunta->exists($id)) {
			throw new NotFoundException(__('Pregunta inválida'));
		}

		if ($this->request->is(array('post', 'put'))) {
			if ($this->Pregunta->save($this->request->data)) {
				$this->Session->setFlash(__('La pregunta ha sido guardada.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La pregunta no ha podido ser guardada. Por favor, intente nuevamente.'));
			}
		} else {
			$options = array('conditions' => array('Pregunta.' . $this->Pregunta->primaryKey => $id));
			$this->request->data = $this->Pregunta->find('first', $options);

			$this->set('tiposDePreguntas', array(
				'texto' => 'Texto',
				'number' => 'Numerico',
				'select' => 'Menu Desplegable',
				'checkbox' => 'Check Box',
				'radio' => 'Radio Button'
			));
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
			throw new NotFoundException(__('Pregunta inválida'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Pregunta->delete()) {
			$this->Session->setFlash(__('La pregunta ha sido borrada.'));
		} else {
			$this->Session->setFlash(__('La pregunta no ha podido ser borrada. Por favor, intente nuevamente.'));
		}
		return $this->redirect(array('action' => 'index'));
	}


  public function activate($id = null, $value = 0) {
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
