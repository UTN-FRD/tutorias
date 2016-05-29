<?php
$this->assign('title', 'Usuarios');
$this->Html->css('index', array('inline' => false));
$this->Html->script('index', array('inline' => false));
?>

<div class="row">
  <div class="col-md-12">
    <div class="page-title">
      <h2><?php echo __('Usuarios'); ?></h2>
    </div>
  </div>

  <div class="col-lg-12">
    <div class="text-right">
      <?php
      echo $this->Html->link(__('Agregar usuario'), array('action' => 'add'), array('class' => 'btn btn-add btn-default'));
      ?>
    </div>
  </div>

  <div class="col-md-12">
    <table class="table">
      <thead>
        <tr>
          <th><?php echo $this->Paginator->sort('id'); ?></th>
          <th><?php echo $this->Paginator->sort('username', 'Nombre de usuario'); ?></th>
          <th><?php echo $this->Paginator->sort('role', 'Rol'); ?></th>
          <th class="actions"></th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($users as $user) { ?>
          <tr>
            <td><?php echo h($user['User']['id']); ?>&nbsp;</td>
            <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
            <td><?php echo h($user['User']['role']); ?>&nbsp;</td>

            <td class="actions">
              <?php
              echo $this->Html->link(__('Editar'), array('action' => 'edit', $user['User']['id']), array('class' => 'btn btn-default'));
              if (AuthComponent::user('id') <> $user['User']['id']) {
              ?>
                <a
                  type="button"
                  class="btn btn-default"
                  data-toggle="modal"
                  data-target="#confirmar-baja"
                  data-id=<?php echo $user['User']['id'] ?>
                  data-nombre=<?php echo h($user['User']['username']) ?>
                >Borrar</a>
              <?php } else { ?>
                <a
                  type="button"
                  class="btn btn-default disabled"
                >Borrar</a>
              <?php } ?>
            </td>
          </tr>
        <?php } ?>
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
