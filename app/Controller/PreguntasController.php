<?php
App::uses('AppController', 'Controller');

class PreguntasController extends AppController {
	public $paginate = [
		'limit' => 25,
		'order' => [
			'Pregunta.activo' => 'desc',
			'Pregunta.orden' => 'asc'
		]
	];

	public function index() {
		$this->Pregunta->recursive = 0;

		$preguntas = $this->paginate();

		/**
		 * Si el contenido de 'valores' es de 120 caracteres o más, lo trunca hasta el último
		 * valor encontrado en sus primeros 120 caracteres y agrega puntos suspensivos.
		 */
		foreach ($preguntas as $key => $pregunta) {
			if (strlen($pregunta['Pregunta']['valores']) > 120) {
				$valores = substr($pregunta['Pregunta']['valores'], 0, 120);

				$ultimo_valor = strrpos($valores, ',');
				if ($ultimo_valor) {
					$valores = substr($valores, 0, $ultimo_valor);
				}

				$preguntas[$key]['Pregunta']['valores'] = $valores.'...';
			}
		}

		$this->set('preguntas', $preguntas);
	}

	public function add() {
		$carreras = $this->Pregunta->Carrera->find('list');

		$this->set(array(
			'tipos' => $this->Pregunta->tipos(),
			'carreras' => array_reverse($carreras, true)
		));

		if ($this->request->is('post')) {
			$this->Pregunta->create();

			if ($this->Pregunta->save($this->request->data)) {
				$this->Flash->success('La pregunta ha sido creada correctamente.');
				return $this->redirect(array('action' => 'index'));
			}

			$this->Flash->error('No se ha podido crear la pregunta. Por favor, intente nuevamente.');
		}
	}

	public function edit($id = null) {
		$this->Pregunta->id = $id;
		if (!$this->Pregunta->exists()) {
			throw new NotFoundException('Pregunta inválida');
		}

		$carreras = $this->Pregunta->Carrera->find('list');

		$this->set(array(
			'tipos' => $this->Pregunta->tipos(),
			'carreras' => array_reverse($carreras, true),
			'opciones' => explode(",", $this->Pregunta->field('valores'))
		));

		if ($this->request->is(array('post', 'put'))) {
			if ($this->Pregunta->save($this->request->data)) {
				$this->Flash->success('La pregunta ha sido actualizada correctamente.');
				return $this->redirect(array('action' => 'index'));
			}

			$this->Flash->error('No se ha podido actualizar la pregunta. Por favor, intente nuevamente.');
		}

		$this->request->data = $this->Pregunta->read();
	}

	public function activate($id = null, $value = 0) {
		$this->request->allowMethod('post');
		$this->autoRender = false;

		$this->Pregunta->id = $id;
		if (!$this->Pregunta->exists()) {
			throw new NotFoundException('Pregunta inválida');
		}

		$estado = $this->Pregunta->field('activo');
		if ($estado != $value) {
			$this->Pregunta->saveField('activo', $value);
		}
	}
}
