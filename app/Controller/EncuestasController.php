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
/*			'joins' => array(
							array(
								'table' => 'encuestas',
							    'alias' => 'en',
							    'type' => 'RIGHT',
							    'conditions' => array('en.pregunta_id = Pregunta.id',
							    	'en.estudiante_id'=>$id)
							    )
					)
*/
//			'conditions' => ['Estudiante.id' => $id]
			'contain' => array('Encuesta'=>array('Estudiante'=>array('conditions'=>['Estudiante.id' => $id])) )
		);

/*
SQL Query: SELECT `Encuesta`.`id`, `Encuesta`.`estudiante_id`, `Encuesta`.`pregunta_id`, `Encuesta`.`respuesta`, `Encuesta`.`legajo`, `Estudiante`.`id`, `Estudiante`.`legajo`, `Estudiante`.`nombre`, `Estudiante`.`carrera`, `Estudiante`.`tutor_id`, `Pregunta`.`id`, `Pregunta`.`pregunta`, `Pregunta`.`orden` FROM `tutorias`.`encuestas` AS `Encuesta` LEFT JOIN `tutorias`.`estudiantes` AS `Estudiante` ON (`Encuesta`.`estudiante_id` = `Estudiante`.`id`) LEFT JOIN `tutorias`.`preguntas` AS `Pregunta` ON (`Encuesta`.`pregunta_id` = `Pregunta`.`id`) RIGHT JOIN `tutorias`.`encuestas` AS `Encuesta` ON (`Encuesta`.`pregunta_id` = `Pregunta`.`id` AND `Encuesta`.`estudiante_id` = '1') WHERE 1 = 1
*/

		$respuestasDelEstudiante = $this->Encuesta->find('all', array('conditions' => ['Estudiante.id' => $id]));

		$respuestasIds = Hash::extract( $respuestasDelEstudiante, '{n}.Pregunta.id');

		$sinResponder = $this->Encuesta->Pregunta->find('all');

		//debug($sinResponder);

		$this->set('encuestas', $respuestasDelEstudiante);

//		$this->set('encuestas', $this->Encuesta->Pregunta->find('all',$options));

	}
}

