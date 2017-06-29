<?php
$this->assign('title', 'Tutorías - UTN FRD');
$this->Html->css('user', array('inline' => false));
?>

<div class="row login">
  <div class="col-md-6">
    <div class="page-title">
      <h1>Bienvenido</h1>
    </div>

    <p>
      Por favor, ingrese su nombre de usuario y contraseña.
    </p>
    <p>
      Si olvidó sus credenciales de acceso, por favor, comuníquese con el administrador de <?php echo strtolower(Configure::read('APP.TITLE')) ?> o diríjase a la oficina de SAE.
    </p>
  </div>

  <div class="col-md-6">
    <div class="alert alert-success">
      <?php echo $this->Form->create('User'); ?>

      <fieldset>
        <div class="form-group">
          <label for="username" class="control-label">Nombre de usuario</label>
          <input
            name="data[User][username]"
            id="username"
            autocomplete="off"
            type="text"
            autofocus required
          >
        </div>

        <div class="form-group">
          <label for="password" class="control-label">Contraseña</label>
          <input
            name="data[User][password]"
            id="password"
            autocomplete="off"
            type="password"
            required
          >
        </div>

        <div class="form-group">
          <button class="btn btn-success" type="submit">Login</button>
        </div>
      </fieldset>

      <?php echo $this->Form->end(); ?>
    </div>
  </div>
</div>
