<?php
$this->Html->css('encuesta/index', array('inline' => false));
$this->Html->script('encuesta/index', array('inline' => false));
$this->Html->script('lib/jquery.form.min', array('inline' => false));
?>

<div class="row">
  <div class="col-md-12">
    <h2>
      <?php echo __('Encuesta de '); ?>
      <?php
      echo $this->Html->link(
          $estudiante['nombre'],
          array('controller' => 'estudiantes', 'action' => 'edit', $estudiante['id'])
        );
      ?>
    </h2>
  </div>

  <div class="col-md-12">
    <?php if (AuthComponent::user('role') == 'admin') { ?>
      <div class="col-lg-12">
        <div class="text-right">
          <?php
          echo $this->Form->postLink(__('Regenerar encuesta'), array('action' => 'regenerate', $estudiante['id']), array('class' => 'btn btn-default'));
          ?>
        </div>
      </div>
    <?php } ?>

    <?php foreach ($encuestas as $encuesta) { ?>
      <form
        class="form-group has-feedback"
        action="<?php echo Router::url(array('action' => 'save')) ?>"
        method="post"
        data-encuesta="<?php echo $encuesta['Pregunta']['id'] ?>"
      >
        <fieldset>
          <div class="form-group">
            <legend>
              <?php echo h($encuesta['Pregunta']['pregunta']); ?>
            </legend>

            <input
              type="hidden"
              name="encuestaId"
              id="encuestaId"
              value="<?php echo h($encuesta['Encuesta']['id']); ?>"
            />

            <?php if ($encuesta['Pregunta']['ayuda']) { ?>
              <div class="alert alert-warning" role="alert">
                <?php echo h($encuesta['Pregunta']['ayuda']); ?>
              </div>
            <?php
            }

            $valores = explode(',', h($encuesta['Pregunta']['valores']));

            switch (Pregunta::tipos($encuesta['Pregunta']['tipo'])) {
              case 'Menú Desplegable':
                ?> <div class="input-group"> <?php
                echo $this->Form->select('respuesta', $valores, array(
                  'class'   => 'form-control',
                  'label'   => false,
                  'legend'  => false,
                  'empty'   => false,
                  'value'   => h($encuesta['Encuesta']['respuesta'])
                ));
                ?> </div> <?php
                break;
              case 'Radio Button':
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
              case 'Check Box':
                echo $this->Form->input('respuesta', array(
                  'multiple' => 'checkbox',
                  'label'    => false,
                  'legend'   => false,
                  'options'  => $valores,
                  'selected' => explode(',', h($encuesta['Encuesta']['respuesta']))
                ));
                break;
              case 'Texto':
                ?>
                <div class="input-group">
                  <textarea
                    name="respuesta"
                    class="form-control"
                  ><?php echo h($encuesta['Encuesta']['respuesta']) ?></textarea>
                </div>
                <?php
                break;
              case 'Numérico':
                ?>
                <div class="input-group">
                  <input
                    name="respuesta"
                    type="text"
                    class="form-control"
                    value="<?php echo h($encuesta['Encuesta']['respuesta']) ?>"
                  >
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
