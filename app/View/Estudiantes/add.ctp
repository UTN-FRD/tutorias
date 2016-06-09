<?php
$this->Html->css('form', array('inline' => false));
$this->Html->script('lib/jquery.validate.min', array('inline' => false));
$this->Html->script('estudiante/form', array('inline' => false));
$this->Html->script('form-submit', array('inline' => false));
?>

<div class="row">
  <div class="col-lg-11 legend">
    <legend>
      <?php echo __('Agregar estudiante'); ?>
    </legend>
  </div>

  <?php
  echo $this->Form->create('Estudiante', array(
    'id' => 'form-submit',
    'class' => 'form-horizontal',
    'data-estudiante' => ''
  ));
  ?>

  <div class="col-lg-12">
    <fieldset>
      <div class="form-group">
        <label for="legajo" class="col-sm-3 control-label">Legajo</label>
        <div class="col-sm-8">
          <input
            name="data[Estudiante][legajo]"
            id="legajo"
            autocomplete="off"
            class="form-control"
            type="number"
            autofocus required
          ><span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        </div>
      </div>

      <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Nombre</label>
        <div class="col-sm-8">
          <input
            name="data[Estudiante][nombre]"
            id="nombre"
            autocomplete="off"
            class="form-control"
            type="text"
            required
          ><span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        </div>
      </div>

      <div class="form-group">
        <label for="carrera" class="col-sm-3 control-label">Carrera</label>
        <div class="col-sm-8">
          <?php
          echo $this->Form->input('carrera_id', array(
            'id' => 'carrera',
            'label' => false,
            'class' => 'form-control',
          ));
          ?>
        </div>
      </div>

      <div class="form-group">
        <label for="tutor" class="col-sm-3 control-label">Tutor</label>
        <div class="col-sm-8">
          <?php
          echo $this->Form->input('user_id', array(
            'id' => 'tutor',
            'label' => false,
            'class' => 'form-control'
          ));
          ?>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-4">
          <a href="#" id="btn-submit" class="btn btn-success">Guardar</a>
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
