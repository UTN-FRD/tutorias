<?php
App::uses('AppController', 'Controller');
App::import('Model', 'Tutore');
App::import('Model', 'Estudiante');
App::import('Model', 'Pregunta');
App::import('Model', 'Encuesta');
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

	function add(){
		$tutore = new Tutore(); 
        $this->set('tutores', 
        	$tutore->find('list', 
        		array('fields' => array('Tutore.id', 'Tutore.nombre'))
        		));

		$this->set('carreras', 
			array(
				    'Ingeniería en Sistemas' => 'Ingeniería en Sistemas',
				    'Ingeniería Mecanica' => 'Ingeniería Mecanica',
				    'Ingeniería Electrica' => 'Ingeniería Electrica',
				    'Ingeniería Química' => 'Ingeniería Química'
				)
        	);

		if ($this->request->is(array('estudiante', 'post'))) {

			$estudiante = new Estudiante();
			$estudiante->legajo = $this->request->data['Estudiante']['legajo'];
			$estudiante->nombre = $this->request->data['Estudiante']['nombre'];
			$estudiante->carrera = $this->request->data['Estudiante']['carrera'];
			$estudiante->tutor_id = $this->request->data['Estudiante']['tutores'];

$result = 'saving student ';

	        if ($this->Estudiante->save($estudiante) ){
	        	$estudiante_id = $estudiante->id;
	        	$result .= $estudiante_id.'-';
	        	$pregunta = new Pregunta(); 
	        	$preguntas = $pregunta->find('list',array());
				foreach($preguntas as $p ){
					$encuesta = new Encuesta();
					$encuesta->estudiante_id = $estudiante_id;
					$encuesta->pregunta_id = $p;
					$pregunta->save($encuesta);

				}



	            $this->Session->setFlash(__($result));
	            return $this->redirect(array('action' => 'index'));
	        }
	        $this->Session->setFlash(__('Unable to update your estudiante.'));
	    }
	     
	    
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
