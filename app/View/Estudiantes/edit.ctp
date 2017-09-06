<?php
$this->Html->script('jquery.validate', array('inline' => false));
$this->Html->script('form-validate', array('inline' => false));
$this->Html->script('estudiante.form-app', array('inline' => false));
?>

<div class="row form-app">
  <div class="col-md-12 page-title">
    <h3>Editar <?php echo Plataforma::esTutorias() ? 'estudiante' : 'graduado'?></h3>
  </div>

  <?php
  echo $this->Form->create('Estudiante', array(
    'class' => 'form-horizontal form-validate',
    'data-estudiante' => $this->request->data['Estudiante']['id']
  ));
  ?>

  <fieldset class="col-md-12">
    <div class="form-group">
      <label for="legajo" class="control-label"><?php echo Plataforma::esTutorias() ? 'Legajo' : 'DNI'?></label>
      <div class="control-input">
        <input
          name="data[Estudiante][legajo]"
          id="legajo"
          autocomplete="off"
          class="form-control"
          type="number"
          value="<?php echo h($this->request->data['Estudiante']['legajo']); ?>"
          autofocus required
        ><span class="glyphicon form-control-feedback" aria-hidden="true"></span>
      </div>
    </div>

    <div class="form-group">
      <label for="nombre" class="control-label">Nombre</label>
      <div class="control-input">
        <input
          name="data[Estudiante][nombre]"
          id="nombre"
          autocomplete="off"
          class="form-control"
          type="text"
          value="<?php echo h($this->request->data['Estudiante']['nombre']); ?>"
          required
        ><span class="glyphicon form-control-feedback" aria-hidden="true"></span>
      </div>
    </div>

    <div class="form-group">
      <label for="carrera" class="control-label">Carrera</label>
      <div class="control-input">
        <?php
        echo $this->Form->input('carrera_id', array(
          'id' => 'carrera',
          'label' => false,
          'class' => 'form-control'
        ));
        ?>
      </div>
    </div>

    <?php if (AuthComponent::user('role') == 'admin') { ?>
      <div class="form-group">
        <label for="tutor" class="control-label"><?php echo Plataforma::esTutorias() ? 'Tutor' : 'Usuario'?></label>
        <div class="control-input">
          <?php
          echo $this->Form->input('user_id', array(
            'id' => 'tutor',
            'label' => false,
            'class' => 'form-control'
          ));
          ?>
        </div>
      </div>
    <?php } ?>

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
