
<div class="col-md-6">
	<h1>Bienvenido</h1>
	<p>Por favor, ingrese su nombre de usuario y contraseña.</p>
	<p>Si olvidó sus credenciales de acceso, por favor, comuniquese con el administrador de tutorias o dirijase a la oficina de SAE</p>
</div>

<div class="col-md-6">
	<div class="alert alert-success">
		<?php
		echo $this->Session->flash('auth');
		echo $this->Form->create('User');
		echo $this->Form->input('username', array(
			'autocomplete' => 'off'
		));
		echo $this->Form->input('password');
		?>
		
		<button class="btn btn-success" type="submit">Login</button>
	</div>
</div>
