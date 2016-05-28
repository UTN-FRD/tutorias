<?php
$this->Html->css('form', array('inline' => false));
$this->Html->script('lib/autosize.min', array('inline' => false));
$this->Html->script('lib/jquery.validate.min', array('inline' => false));
$this->Html->script('pregunta/form', array('inline' => false));
$this->Html->script('form-submit', array('inline' => false));
?>

<div class="row">
  <div class="col-lg-11 legend">
    <legend>
      <?php echo __('Editar pregunta'); ?>
    </legend>
  </div>

  <?php echo $this->Form->create('Pregunta', array(
    'id' => 'form-submit',
    'class' => 'form-horizontal',
    'data-pregunta' => $this->request->data['Pregunta']
  )); ?>

  <div class="col-lg-12">
    <fieldset>
      <div class="form-group">
        <label for="orden" class="col-sm-3 control-label">Orden</label>
        <div class="col-sm-8">
          <input name="data[Pregunta][orden]" id="orden" autocomplete="off" class="form-control" type="number" value="<?php echo h($this->request->data['Pregunta']['orden']) ?>" autofocus required>
          <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        </div>
      </div>

      <div class="form-group">
        <label for="pregunta" class="col-sm-3 control-label">Pregunta</label>
        <div class="col-sm-8">
          <input name="data[Pregunta][pregunta]" id="pregunta" autocomplete="off" class="form-control" type="text" value="<?php echo h($this->request->data['Pregunta']['pregunta']) ?>" required>
          <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        </div>
      </div>

      <div class="form-group">
        <label for="ayuda" class="col-sm-3 control-label">Ayuda</label>
        <div class="col-sm-8">
          <textarea name="data[Pregunta][ayuda]" id="ayuda" autocomplete="off" class="form-control" type="text"><?php echo h($this->request->data['Pregunta']['ayuda']) ?></textarea>
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

      <div class="form-group">
        <label for="valores" class="col-sm-3 control-label">Opciones</label>
        <div class="col-sm-8">
          <input name="data[Pregunta][valores]" id="valores" autocomplete="off" class="form-control" type="text" value="<?php echo h($this->request->data['Pregunta']['valores']) ?>">
          <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-4">
          <a id="btn-submit" class="btn btn-success">Guardar</a>
          <a id="btn-cancelar" class="btn btn-default" href="/tutorias/preguntas">Cancelar</a>
        </div>
      </div>
    </fieldset>
  </div>
</div>
