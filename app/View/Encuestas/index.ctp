<?php
$this->Html->css('daterangepicker', array('inline' => false));
$this->Html->css('encuesta', array('inline' => false));
$this->Html->script('autosize', array('inline' => false));
$this->Html->script('jquery.form', array('inline' => false));
$this->Html->script('moment', array('inline' => false));
$this->Html->script('daterangepicker', array('inline' => false));
$this->Html->script('encuesta', array('inline' => false));
?>

<div class="row encuesta">
  <div class="col-md-12 page-title">
    <h2>Encuesta de
      <?php
      echo $this->Html->link(
        $estudiante['nombre'],
        array('controller' => 'estudiantes', 'action' => 'edit', $estudiante['id'])
      );
      ?>
    </h2>
  </div>

  <?php if (AuthComponent::user('role') == 'admin') { ?>
    <div class="col-md-12 text-right">
      <?php
      echo $this->Form->postLink(
        'Regenerar encuesta',
        array('action' => 'regenerate', $estudiante['id']),
        array('class' => 'btn btn-default')
      );
      ?>
    </div>
  <?php } ?>

  <div class="col-md-12">
    <?php foreach ($encuestas as $encuesta) { ?>
      <form
        class="form-group has-feedback"
        method="post"
        action="<?php echo Router::url(array('action' => 'save')); ?>"
        data-pregunta="<?php echo $encuesta['Pregunta']['id']; ?>"
      >
        <fieldset class="form-group">
          <legend>
            <?php echo h($encuesta['Pregunta']['pregunta']); ?>
            <span class="form-control-feedback"></span>
          </legend>

          <input
            type="hidden"
            name="encuestaId"
            value="<?php echo h($encuesta['Encuesta']['id']); ?>"
          >

          <?php if ($encuesta['Pregunta']['ayuda']) { ?>
            <div class="alert alert-warning" role="alert">
              <?php echo nl2br(h($encuesta['Pregunta']['ayuda'])); ?>
            </div>
          <?php
          }

          $valores = explode(',', h($encuesta['Pregunta']['valores']));

          switch ($encuesta['Pregunta']['tipo']) {
            case Pregunta::TIPO_MENU:
              ?> <div class="form-group input-select"> <?php
              echo $this->Form->select($encuesta['Encuesta']['id'] . ':', $valores, array(
                'name' => 'respuesta',
                'class' => 'input select form-control',
                'value' => h($encuesta['Encuesta']['respuesta']),
                'label' => false,
                'legend' => false
              ));
              ?> </div> <?php
              break;
            case Pregunta::TIPO_RADIO:
              echo $this->Form->input($encuesta['Encuesta']['id'] . ':', array(
                'name' => 'respuesta',
                'type' => 'radio',
                'legend' => false,
                'div' => 'input input-group',
                'before' => '<div class="radio">',
                'after' => '</div>',
                'separator' => '</div><div class="radio">',
                'value' => h($encuesta['Encuesta']['respuesta']),
                'options' => $valores
              ));
              break;
            case Pregunta::TIPO_CHECKBOX:
              echo $this->Form->input($encuesta['Encuesta']['id'] . ':', array(
                'name' => 'respuesta',
                'div' => 'input input-group',
                'label' => false,
                'legend' => false,
                'options' => $valores,
                'selected' => explode(',', h($encuesta['Encuesta']['respuesta'])),
                'multiple' => 'checkbox'
              ));
              break;
            case Pregunta::TIPO_TEXTO:
              ?>
              <div class="form-group input-text">
                <textarea
                  name="respuesta"
                  class="input text form-control"
                  rows="5"
                ><?php echo h($encuesta['Encuesta']['respuesta']); ?></textarea>
              </div>
              <?php
              break;
            case Pregunta::TIPO_NUMERICO:
              ?>
              <div class="form-group input-number">
                <input
                  name="respuesta"
                  type="text"
                  class="input number form-control"
                  value="<?php echo h($encuesta['Encuesta']['respuesta']); ?>"
                >
              </div>
              <?php
              break;
            case Pregunta::TIPO_FECHA:
              ?>
              <div class="form-group input-date">
                <input
                  name="respuesta"
                  type="text"
                  class="input daterange form-control"
                  value="<?php echo h($encuesta['Encuesta']['respuesta']); ?>"
                ><span class="glyphicon glyphicon-calendar"></span>
              </div>
              <?php
              break;
          } ?>
        </fieldset>
      </form>
    <?php } ?>
  </div>
</div>
