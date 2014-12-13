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

/**
 * Components
 *
 * @var array
 */
	public $scaffold;
	public $components = array('Paginator', 'Session');

	function index($id = null){
		if (!$id) {
	        throw new NotFoundException(__('Estudiante Invalido'));
	    }

		$conditions = array(
			'fields' => array('Encuesta.id','Encuesta.respuesta','Encuesta.legajo','Estudiante.id','Estudiante.nombre','Pregunta.pregunta'),
			'conditions' => ['Estudiante.id' => $id]
		);

		$options = array(
			'joins' => array(
							array(
								'table' => 'encuestas',
							    'alias' => 'Encuesta',
							    'type' => 'RIGHT',
							    'conditions' => array('Encuesta.pregunta_id = Pregunta.id',
							    	'Encuesta.estudiante_id'=>$id)							)
					)
			
		);

/*
SQL Query: SELECT `Encuesta`.`id`, `Encuesta`.`estudiante_id`, `Encuesta`.`pregunta_id`, `Encuesta`.`respuesta`, `Encuesta`.`legajo`, `Estudiante`.`id`, `Estudiante`.`legajo`, `Estudiante`.`nombre`, `Estudiante`.`carrera`, `Estudiante`.`tutor_id`, `Pregunta`.`id`, `Pregunta`.`pregunta`, `Pregunta`.`orden` FROM `tutorias`.`encuestas` AS `Encuesta` LEFT JOIN `tutorias`.`estudiantes` AS `Estudiante` ON (`Encuesta`.`estudiante_id` = `Estudiante`.`id`) LEFT JOIN `tutorias`.`preguntas` AS `Pregunta` ON (`Encuesta`.`pregunta_id` = `Pregunta`.`id`) RIGHT JOIN `tutorias`.`encuestas` AS `Encuesta` ON (`Encuesta`.`pregunta_id` = `Pregunta`.`id` AND `Encuesta`.`estudiante_id` = '1') WHERE 1 = 1
*/
		$this->set('encuestas', $this->Encuesta->find('all',$options));

	}
}

