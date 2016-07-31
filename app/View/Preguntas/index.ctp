<?php
$this->Html->css('bootstrap-toggle', array('inline' => false));
$this->Html->css('footable.core.bootstrap', array('inline' => false));
$this->Html->css('pregunta', array('inline' => false));
$this->Html->script('bootstrap-toggle', array('inline' => false));
$this->Html->script('footable.core', array('inline' => false));
$this->Html->script('pregunta.index', array('inline' => false));
?>

<div class="row index">
  <div class="col-md-12 page-title">
    <h2>Preguntas</h2>
  </div>

  <div class="col-md-12 text-right">
    <?php
    echo $this->Html->link(
      'Agregar pregunta',
      array('action' => 'add'),
      array('class' => 'btn btn-add btn-default')
    );
    ?>
  </div>

  <div class="col-md-12">
    <table class="table">
      <thead>
        <tr>
          <th>
            <?php echo $this->Paginator->sort('orden'); ?>
          </th>
          <th>
            <?php echo $this->Paginator->sort('pregunta'); ?>
          </th>
          <th>
            <?php echo $this->Paginator->sort('tipo'); ?>
          </th>
          <th data-breakpoints="xs sm" data-type="html">
            <?php echo $this->Paginator->sort('valores', 'Opciones'); ?>
          </th>
          <th data-breakpoints="xs" data-type="html">
            <?php echo $this->Paginator->sort('Carrera.descripcion', 'Visible en'); ?>
          </th>
          <th data-breakpoints="xs sm" data-type="html" class="tx-activo">
            <?php echo $this->Paginator->sort('activo', 'Activa'); ?>
          </th>
          <th data-breakpoints="xs sm" data-type="html" class="tx-actions"></th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($preguntas as $pregunta) { ?>
          <tr>
            <td class="no-wrap">
              <?php echo h($pregunta['Pregunta']['orden']); ?>
            </td>
            <td>
              <?php echo h($pregunta['Pregunta']['pregunta']); ?>
            </td>
            <td class="no-wrap">
              <?php echo h(Pregunta::tipos($pregunta['Pregunta']['tipo'])); ?>
            </td>
            <td class="td-opciones">
              <span class="footable-title">Opciones:</span>
              <?php echo h($pregunta['Pregunta']['valores']); ?>
            </td>
            <td class="no-wrap">
              <span class="footable-title">Visible en:</span>
              <?php echo h($pregunta['Carrera']['descripcion']); ?>
            </td>
            <td class="tx-activo no-wrap">
              <span class="footable-title">Activa:</span>
              <?php
              echo $this->Form->checkbox('activo', array(
                'id' => $pregunta['Pregunta']['id'],
                'data-toggle' => 'toggle',
                'data-size' => 'small',
                'checked' => $pregunta['Pregunta']['activo'],
                'class' => 'checkbox-toggle',
                'label' => false
              ));
              ?>
            </td>
            <td class="tx-actions">
              <?php
              echo $this->Html->link(
                'Editar',
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
        'format' => 'Mostrando {:current} de {:count} resultados'
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
