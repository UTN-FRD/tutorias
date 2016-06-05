<?php
$this->Html->css('index', array('inline' => false));
$this->Html->script('index', array('inline' => false));
?>

<div class="row">
  <div class="col-md-12">
    <div class="page-title">
      <h2><?php echo __('Estudiantes'); ?></h2>
    </div>
  </div>

  <?php if (AuthComponent::user('role') == 'admin') { ?>
    <div class="col-lg-12">
      <div class="text-right">
        <?php
        echo $this->Html->link(__('Agregar estudiante'), array('action' => 'add'), array('class' => 'btn btn-add btn-default'));
        ?>
      </div>
    </div>
  <?php } ?>

  <div class="col-md-12">
    <table class="table">
      <thead>
        <tr>
          <th><?php echo $this->Paginator->sort('legajo'); ?></th>
          <th><?php echo $this->Paginator->sort('nombre'); ?></th>
          <th><?php echo $this->Paginator->sort('carrera'); ?></th>
          <th><?php echo $this->Paginator->sort('tutor'); ?></th>
          <th class="actions"></th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($estudiantes as $estudiante): ?>
        <tr>
          <td><?php echo h($estudiante['Estudiante']['legajo']); ?>&nbsp;</td>
          <td><?php echo h($estudiante['Estudiante']['nombre']); ?>&nbsp;</td>
          <td><?php echo h($estudiante['Carrera']['descripcion']); ?>&nbsp;</td>
          <td><?php echo h($estudiante['User']['username']); ?>&nbsp;</td>

          <td class="actions">
            <?php
            echo $this->Html->link(
                'Encuesta',
                array('controller' => 'encuestas', 'action' => 'index', $estudiante['Estudiante']['id']),
                array('class' => 'btn btn-default')
              );
            ?>
            <?php
            echo $this->Html->link(__('Editar'), array('action' => 'edit', $estudiante['Estudiante']['id']), array('class' => 'btn btn-default'));
            if (AuthComponent::user('role') == 'admin') {
            ?>
              <a
                type="button"
                class="btn btn-default"
                data-toggle="modal"
                data-target="#confirmar-baja"
                data-id=<?php echo $estudiante['Estudiante']['id'] ?>
                data-nombre=<?php echo h($estudiante['Estudiante']['nombre']) ?>
              >Borrar</a>
            <?php } ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <!-- Modal -->
    <div id="confirmar-baja" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Eliminar estudiante</h4>
          </div>
          <div class="modal-body"></div>
          <div class="modal-footer">
            <form method="post">
              <button type="button" id="btn-submit" class="btn btn-danger">Sí</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <p class="paginator">
      <?php
      echo $this->Paginator->counter(array(
        'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
      ));
      ?>
    </p>

    <div class="paging text-center">
      <?php
      if ($this->Paginator->hasPrev() || $this->Paginator->hasNext()) {
        echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
      }
      ?>
    </div>
  </div>
</div>
