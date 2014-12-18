<?php
App::uses('AppController', 'Controller');
App::import('Model', 'Tutore');
/**
 * Estudiantes Controller
 *
 */
class EstudiantesController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;

	public $helpers = array('Html','Form');

	public $paginate = [
        'limit' => 25,
        'order' => [
            'Estudiante.nombre' => 'asc'
        ]
    ];

	function index(){
		$this->set('estudiantes', $this->paginate('Estudiante'));
	}

	function edit($id = null) {
		$tutore = new Tutore(); 
        $this->set('tutores', 
        	$tutore->find('list', 
        		array('fields' => array('Tutore.id', 'Tutore.nombre'))
        		));

	    if (!$id) {
	        throw new NotFoundException(__('Invalid tutor'));
	    }

	    $estudiante = $this->Estudiante->findById($id);
	    if (!$estudiante) {
	        throw new NotFoundException(__('Invalid estudiante'));
	    }

	    if ($this->request->is(array('estudiante', 'put'))) {
	        $this->Estudiante->id = $id;
	        if ($this->Estudiante->save($this->request->data)) {
	            $this->Session->setFlash(__('Your estudiante has been updated.'));
	            return $this->redirect(array('action' => 'index'));
	        }
	        $this->Session->setFlash(__('Unable to update your estudiante.'));
	    }

	    if (!$this->request->data) {
	        $this->request->data = $estudiante;
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
}
