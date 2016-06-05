<?php
$this->assign('title', 'Usuarios');
$this->Html->css('form', array('inline' => false));
$this->Html->script('lib/jquery.validate.min', array('inline' => false));
$this->Html->script('user/form', array('inline' => false));
$this->Html->script('form-submit', array('inline' => false));
?>

<div class="row">
  <div class="col-lg-11 legend">
    <legend>
      <?php echo __('Editar usuario'); ?>
    </legend>
  </div>

  <?php echo $this->Form->create('User', array(
    'id' => 'form-submit',
    'class' => 'form-horizontal',
    'data-user' => $this->request->data['User']['id']
  )); ?>

  <div class="col-lg-12">
    <fieldset>
      <div class="form-group">
        <label for="username" class="col-sm-3 control-label">Nombre de usuario</label>
        <div class="col-sm-8">
          <input name="data[User][username]" id="username" autocomplete="off" class="form-control" type="text" value="<?php echo h($this->request->data['User']['username']) ?>" required>
          <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        </div>
      </div>

      <div class="form-group">
        <label for="password" class="col-sm-3 control-label">Contraseña</label>
        <div class="col-sm-8">
          <input name="data[User][password]" id="password" autocomplete="off" class="form-control" type="password" required>
          <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        </div>
      </div>

      <div class="form-group">
        <label for="confirmPassword" class="col-sm-3 control-label">Repita su contraseña</label>
        <div class="col-sm-8">
          <input name="confirmPassword" id="confirmPassword" autocomplete="off" class="form-control" type="password" required>
          <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-4">
          <a id="btn-submit" class="btn btn-success">Guardar</a>
          <?php
          echo $this->Html->link(
            'Cancelar',
            array('action' => 'index'),
            array('id' => 'btn-cancelar', 'class' => 'btn btn-default')
          );
          ?>
        </div>
      </div>
    </fieldset>
  </div>
</div>
