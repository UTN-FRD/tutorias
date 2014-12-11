<?php
App::uses('AppController', 'Controller');
/**
 * Tutores Controller
 *
 */
class TutoresController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;

	public $helpers = array('Html','Form');

	function edit($id = null) {
	    if (!$id) {
	        throw new NotFoundException(__('Invalid tutor'));
	    }

	    $tutor = $this->Tutore->findById($id);
	    if (!$tutor) {
	        throw new NotFoundException(__('Invalid tutor'));
	    }

	    if ($this->request->is(array('tutor', 'put'))) {
	        $this->Tutore->id = $id;
	        if ($this->Tutore->save($this->request->data)) {
	            $this->Session->setFlash(__('Your tutor has been updated.'));
	            return $this->redirect(array('action' => 'index'));
	        }
	        $this->Session->setFlash(__('Unable to update your tutor.'));
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
}
