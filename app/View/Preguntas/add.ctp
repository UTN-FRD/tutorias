<?php
$this->Html->css('form', array('inline' => false));
$this->Html->css('pregunta/form', array('inline' => false));
$this->Html->script('lib/autosize.min', array('inline' => false));
$this->Html->script('lib/jquery.validate.min', array('inline' => false));
$this->Html->script('pregunta/form', array('inline' => false));
$this->Html->script('form-submit', array('inline' => false));
?>

<div class="row">
  <div class="col-lg-11 legend">
    <legend>
      <?php echo __('Agregar pregunta'); ?>
    </legend>
  </div>

  <?php echo $this->Form->create('Pregunta', array(
    'id' => 'form-submit',
    'class' => 'form-horizontal',
    'data-pregunta' => ''
  )); ?>

  <div class="col-lg-12">
    <fieldset>
      <div class="form-group">
        <label for="orden" class="col-sm-3 control-label">Orden</label>
        <div class="col-sm-8">
          <input
            name="data[Pregunta][orden]"
            id="orden"
            autocomplete="off"
            class="form-control"
            type="number"
            autofocus required
          ><span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        </div>
      </div>

      <div class="form-group">
        <label for="pregunta" class="col-sm-3 control-label">Pregunta</label>
        <div class="col-sm-8">
          <input
            name="data[Pregunta][pregunta]"
            id="pregunta"
            autocomplete="off"
            class="form-control"
            type="text"
            required
          ><span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        </div>
      </div>

      <div class="form-group">
        <label for="ayuda" class="col-sm-3 control-label">Ayuda</label>
        <div class="col-sm-8">
          <textarea
            name="data[Pregunta][ayuda]"
            id="ayuda"
            autocomplete="off"
            class="form-control"
            type="text"
          ></textarea>
          <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        </div>
      </div>

      <div class="form-group">
        <label for="carrera" class="col-sm-3 control-label">Visible para</label>
        <div class="col-sm-8">
          <?php
          echo $this->Form->input('carrera_id', array(
            'id'    => 'carrera',
            'label' => false,
            'class' => 'form-control'
          ));
          ?>
        </div>
      </div>

      <div class="form-group">
        <label for="tipo" class="col-sm-3 control-label">Tipo</label>
        <div class="col-sm-8">
          <?php
          echo $this->Form->input('tipo', array(
            'id'    => 'tipo',
            'label' => false,
            'class' => 'form-control'
          ));
          ?>
        </div>
      </div>

      <div id="div-opciones" class="form-group">
        <label for="opciones" class="col-sm-3 control-label">Opciones</label>
        <div class="col-sm-8">
          <div id="opciones">
            <div class="opcion">
              <input
                name="data[Pregunta][valores][0]"
                autocomplete="off"
                class="form-control"
                type="text"
              ><a href="#" class="eliminar" title="Eliminar opción">&times;</a>
            </div>
          </div>
          <a id="agregarOpcion" href="#">Agregar Campo</a>
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
