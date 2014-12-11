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

	function index(){
		$conditions = array('fields' => 
			array('Encuesta.id','Encuesta.respuesta','Encuesta.legajo','Estudiante.nombre'));

		$this->set('encuestas', $this->Encuesta->find('all',$conditions));
	}
}

