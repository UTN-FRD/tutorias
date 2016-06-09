<?php
$this->Html->css('index', array('inline' => false));
$this->Html->css('lib/bootstrap-switch.min', array('inline' => false));
$this->Html->script('lib/bootstrap-switch.min', array('inline' => false));
$this->Html->script('pregunta/index', array('inline' => false));
?>

<div class="row">
  <div class="col-md-12">
    <div class="page-title">
      <h2><?php echo __('Preguntas'); ?></h2>
    </div>
  </div>

  <div class="col-lg-12">
    <div class="text-right">
      <?php
      echo $this->Html->link(
        __('Agregar pregunta'),
        array('action' => 'add'),
        array('class' => 'btn btn-add btn-default')
      );
      ?>
    </div>
  </div>

  <div class="col-md-12">
    <table class="table">
      <thead>
        <tr>
          <th><?php echo $this->Paginator->sort('orden'); ?></th>
          <th><?php echo $this->Paginator->sort('pregunta'); ?></th>
          <th><?php echo $this->Paginator->sort('tipo'); ?></th>
          <th><?php echo $this->Paginator->sort('valores'); ?></th>
          <th><?php echo $this->Paginator->sort('visible', 'Visible en'); ?></th>
          <th><?php echo $this->Paginator->sort('activo', 'Activa'); ?></th>
          <th class="actions"></th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($preguntas as $pregunta) { ?>
          <tr>
            <td><?php echo h($pregunta['Pregunta']['orden']); ?></td>
            <td><?php echo h($pregunta['Pregunta']['pregunta']); ?></td>
            <td><?php echo h(Pregunta::tipos($pregunta['Pregunta']['tipo'])); ?></td>
            <td><?php echo h($pregunta['Pregunta']['valores']); ?></td>
            <td><?php echo h($pregunta['Carrera']['descripcion']); ?></td>

            <td class="auto-width">
              <?php
              echo $this->Form->checkbox('activo', array(
                'data-id' => $pregunta['Pregunta']['id'],
                'checked' => $pregunta['Pregunta']['activo'],
                'class' => 'checkbox-switch',
                'label' => false
              ));
              ?>
            </td>

            <td class="actions">
              <?php
              echo $this->Html->link(
                __('Editar'),
                array('action' => 'edit', $pregunta['Pregunta']['id']),
                array('class' => 'btn btn-default btn-sm')
              );
              ?>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

    <p class="paginator">
      <?php
      echo $this->Paginator->counter(array(
        'format' => __('Mostrando {:current} de {:count} resultados')
      ));
      ?>
    </p>

    <div class="paging text-center">
      <?php
      if ($this->Paginator->hasPrev() || $this->Paginator->hasNext()) {
        echo $this->Paginator->prev('«', array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next('»', array(), null, array('class' => 'next disabled'));
      }
      ?>
    </div>
  </div>
</div>
