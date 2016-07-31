<?php
$this->Html->script('jquery.validate', array('inline' => false));
$this->Html->script('form-validate', array('inline' => false));
$this->Html->script('estudiante.form-app', array('inline' => false));
?>

<div class="row form-app">
  <div class="col-md-11 page-title">
    <h3>Agregar estudiante</h3>
  </div>

  <?php
  echo $this->Form->create('Estudiante', array(
    'class' => 'form-horizontal form-validate'
  ));
  ?>

  <fieldset class="col-md-12">
    <div class="form-group">
      <label for="legajo" class="control-label">Legajo</label>
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
      <label for="nombre" class="control-label">Nombre</label>
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
      <label for="carrera" class="control-label">Carrera</label>
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
      <label for="tutor" class="control-label">Tutor</label>
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
