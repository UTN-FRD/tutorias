<?php
App::uses('Encuesta', 'Model');

/**
 * Encuesta Test Case
 *
 */
class EncuestaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.encuesta',
		'app.estudiante',
		'app.pregunta'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Encuesta = ClassRegistry::init('Encuesta');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Encuesta);

		parent::tearDown();
	}

}
