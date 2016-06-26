<?php
App::uses('ExceptionRenderer', 'Error');

class AppExceptionRenderer extends ExceptionRenderer {
	/*
	 * Si el usuario no está logeado, no se le muestran los errores 400 y se lo redirige a
	 * la página principal.
	 */
	public function error400($error) {
		if (!AuthComponent::user()) {
			return $this->controller->redirect('/');
		}

		return parent::error400($error);
	}
}
