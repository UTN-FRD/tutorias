<?php
$this->assign('title', 'Usuarios');
$this->Html->css('user', array('inline' => false));
$this->Html->script('jquery.validate', array('inline' => false));
$this->Html->script('form-validate', array('inline' => false));
$this->Html->script('user.form-app', array('inline' => false));
?>

<div class="row form-app">
  <div class="col-md-12 page-title">
    <h3>Agregar usuario</h3>
  </div>

  <?php
  echo $this->Form->create('User', array(
    'class' => 'form-horizontal form-validate'
  ));
  ?>

  <fieldset class="col-md-12">
    <div class="form-group">
      <label for="username" class="control-label">Nombre de usuario</label>
      <div class="control-input">
        <input
          name="data[User][username]"
          id="username"
          autocomplete="off"
          class="form-control"
          type="text"
          autofocus required
        ><span class="glyphicon form-control-feedback" aria-hidden="true"></span>
      </div>
    </div>

    <div class="form-group">
      <label for="password" class="control-label">Contraseña</label>
      <div class="control-input">
        <input
          name="data[User][password]"
          id="password"
          autocomplete="off"
          class="form-control"
          type="password"
          required
        ><span class="glyphicon form-control-feedback" aria-hidden="true"></span>
      </div>
    </div>

    <div class="form-group">
      <label for="confirm-password" class="control-label">Repita su contraseña</label>
      <div class="control-input">
        <input
          name="confirm-password"
          id="confirm-password"
          autocomplete="off"
          class="form-control"
          type="password"
          required
        ><span class="glyphicon form-control-feedback" aria-hidden="true"></span>
      </div>
    </div>

    <div class="form-group">
      <label for="role" class="control-label">Rol</label>
      <div class="control-input">
        <?php
        echo $this->Form->input('role', array(
          'id' => 'role',
          'label' => false,
          'class' => 'form-control',
          'options' => array(Plataforma::esTutorias() ? 'tutor' : 'usuario' => Plataforma::esTutorias() ? 'Tutor' : 'Usuario' , 'admin' => 'Administrador' , 'administrativo' => 'Administrativo')
        ));
        ?>
      </div>
    </div>

    <div class="btn-toolbar">
      <button class="btn btn-success" type="submit">Guardar</button>
      <?php
      echo $this->Html->link(
        'Cancelar',
        array('action' => 'index'),
        array('id' => 'btn-cancelar', 'class' => 'btn btn-default')
      );
      ?>
    </div>
  </fieldset>

  <?php echo $this->Form->end(); ?>
</div>
