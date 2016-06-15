<?php
$this->Html->css('encuesta/index', array('inline' => false));
$this->Html->css('lib/daterangepicker.min', array('inline' => false));
$this->Html->script('encuesta/index', array('inline' => false));
$this->Html->script('lib/jquery.form.min', array('inline' => false));
$this->Html->script('lib/moment.min', array('inline' => false));
$this->Html->script('lib/daterangepicker.min', array('inline' => false));
$this->Html->script('lib/autosize.min', array('inline' => false));
?>

<div class="row">
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
        action="<?php echo Router::url(array('action' => 'save')); ?>"
        method="post"
        data-encuesta="<?php echo $encuesta['Pregunta']['id']; ?>"
      >
        <fieldset>
          <div class="form-group encuesta">
            <legend>
              <?php echo h($encuesta['Pregunta']['pregunta']); ?>
            </legend>

            <input
              type="hidden"
              name="encuestaId"
              class="input-hidden"
              value="<?php echo h($encuesta['Encuesta']['id']); ?>"
            />

            <?php if ($encuesta['Pregunta']['ayuda']) { ?>
              <div class="alert alert-warning" role="alert">
                <?php echo nl2br(h($encuesta['Pregunta']['ayuda'])); ?>
              </div>
            <?php
            }

            $valores = explode(',', h($encuesta['Pregunta']['valores']));

            switch ($encuesta['Pregunta']['tipo']) {
              case Pregunta::TIPO_MENU:
                ?> <div class="form-group"> <?php
                echo $this->Form->select('respuesta', $valores, array(
                  'class'   => 'input form-control',
                  'label'   => false,
                  'legend'  => false,
                  'value'   => h($encuesta['Encuesta']['respuesta'])
                ));
                ?> </div> <?php
                break;
              case Pregunta::TIPO_RADIO:
                echo $this->Form->input('respuesta', array(
                  'type'      => 'radio',
                  'label'     => false,
                  'legend'    => false,
                  'div'       => 'input select',
                  'before'    => '<div class="radio option">',
                  'after'     => '</div>',
                  'separator' => '</div><div class="radio option">',
                  'value'     => h($encuesta['Encuesta']['respuesta']),
                  'options'   => $valores
                ));
                break;
              case Pregunta::TIPO_CHECKBOX:
                echo $this->Form->input('respuesta', array(
                  'multiple' => 'checkbox',
                  'label'    => false,
                  'legend'   => false,
                  'options'  => $valores,
                  'selected' => explode(',', h($encuesta['Encuesta']['respuesta']))
                ));
                break;
              case Pregunta::TIPO_TEXTO:
                ?>
                <div class="form-group">
                  <textarea
                    name="respuesta"
                    class="input form-control"
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

            <span class="form-control-feedback"></span>
          </div>
        </fieldset>
      </form>
    <?php } ?>
  </div>
</div>
