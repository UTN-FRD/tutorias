<?php
$this->Html->css('pregunta', array('inline' => false));
$this->Html->script('autosize', array('inline' => false));
$this->Html->script('jquery.validate', array('inline' => false));
$this->Html->script('form-validate', array('inline' => false));
$this->Html->script('pregunta.form-app', array('inline' => false));
?>

<div class="row form-app">
  <div class="col-md-11 page-title">
    <h3>Agregar pregunta</h3>
  </div>

  <?php
  echo $this->Form->create('Pregunta', array(
    'class' => 'form-horizontal form-validate'
  ));
  ?>

  <fieldset class="col-md-12">
    <div class="form-group">
      <label for="orden" class="control-label">Orden</label>
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
      <label for="pregunta" class="control-label">Pregunta</label>
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
      <label for="ayuda" class="control-label">Ayuda</label>
      <div class="col-sm-8">
        <textarea
          name="data[Pregunta][ayuda]"
          id="ayuda"
          autocomplete="off"
          class="form-control"
          rows="3"
        ></textarea>
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
      </div>
    </div>

    <div class="form-group">
      <label for="carrera" class="control-label">Visible en</label>
      <div class="col-sm-8">
        <?php
        echo $this->Form->input('carrera_id', array(
          'id' => 'carrera',
          'label' => false,
          'class' => 'form-control'
        ));
        ?>
      </div>
    </div>

    <div class="form-group">
      <label for="tipo" class="control-label">Tipo</label>
      <div class="col-sm-8">
        <?php
        echo $this->Form->input('tipo', array(
          'id' => 'tipo',
          'label' => false,
          'class' => 'form-control'
        ));
        ?>
      </div>
    </div>

    <div class="form-group div-opciones">
      <label class="control-label">Opciones</label>
      <div class="col-sm-8">
        <div class="opciones">
          <div class="opcion">
            <input
              name="data[Pregunta][valores][0]"
              autocomplete="off"
              class="form-control"
              type="text"
            ><a href="#" tabindex="-1" class="eliminar" title="Eliminar opción">&times;</a>
          </div>
        </div>
        <a class="agregar-opcion" href="#">Agregar opción</a>
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
