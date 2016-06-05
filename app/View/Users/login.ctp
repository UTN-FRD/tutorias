<?php
$this->assign('title', 'Tutorías - UTN FRD');
$this->Html->css('user/login', array('inline' => false));
?>

<div class="col-md-6">
  <h1>Bienvenido</h1>
  <p>Por favor, ingrese su nombre de usuario y contraseña.</p>
  <p>Si olvidó sus credenciales de acceso, por favor, comuníquese con el administrador de tutorías o diríjase a la oficina de SAE.</p>
</div>

<div class="col-md-6">
  <div id="login" class="alert alert-success">
    <?php
    echo $this->Form->create('User');
    echo $this->Form->input('username', array(
      'label'        => 'Nombre de usuario',
      'autofocus'    => 'true',
      'autocomplete' => 'off'
    ));
    echo $this->Form->input('password', array(
      'label' => 'Contraseña'
    ));
    ?>

    <div id="submit" class="form-group">
      <button class="btn btn-success" type="submit">Login</button>
    </div>
  </div>
</div>
