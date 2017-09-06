<?php
$this->assign('title', 'Usuarios');
$this->Html->css('footable.core.bootstrap', array('inline' => false));
$this->Html->css('user', array('inline' => false));
$this->Html->script('footable.core', array('inline' => false));
$this->Html->script('user.index', array('inline' => false));
?>

<div class="row index">
  <div class="col-md-12 page-title">
    <h2>Usuarios</h2>

    <a
      class="btn btn-default"
      href="<?php echo Router::url(array('action' => 'add')); ?>"
    >
      <span
        class="visible-md-inline visible-lg-inline"
      >Agregar usuario</span>
      <span
        class="glyphicon glyphicon-plus visible-xs-inline visible-sm-inline"
      ></span>
    </a>
  </div>

  <div class="col-md-12">
    <table class="table">
      <thead>
        <tr>
          <th>
            <?php echo $this->Paginator->sort('id'); ?>
          </th>
          <th>
            <?php echo $this->Paginator->sort('username', 'Nombre de usuario'); ?>
          </th>
          <th>
            <?php echo $this->Paginator->sort('role', 'Rol'); ?>
          </th>
          <th data-breakpoints="xs sm" data-type="html" class="tx-actions"></th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($users as $user) { ?>
          <tr>
            <td class="text-nowrap">
              <?php echo h($user['User']['id']); ?>
            </td>
            <td>
              <?php echo h($user['User']['username']); ?>
            </td>
            <td>
              <?php echo h($user['User']['role']); ?>
            </td>
            <td class="tx-actions text-nowrap">
              <?php
              echo $this->Html->link(
                'Editar',
                array('action' => 'edit', $user['User']['id']),
                array('class' => 'btn btn-default btn-sm', 'role' => 'button')
              );

              if (AuthComponent::user('id') <> $user['User']['id']) {
                echo $this->Html->link(
                  'Borrar',
                  '#',
                  array(
                    'id' => $user['User']['id'],
                    'class' => 'btn btn-danger btn-sm',
                    'data-toggle' => 'modal',
                    'data-target' => '#confirmar',
                    'data-nombre' => $user['User']['username']
                  )
                );
              } else {
                echo $this->Html->link(
                  'Borrar',
                  '#',
                  array('class' => 'btn btn-danger btn-sm disabled')
                );
              }
              ?>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

    <!-- Modal -->
    <div id="confirmar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Eliminar <?php echo Plataforma::esTutorias() ? 'tutor' : 'usuario'?></h4>
          </div>
          <div class="modal-body"></div>
          <div class="modal-footer">
            <form method="post">
              <button type="submit" id="btn-submit" class="btn btn-danger">Sí</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </form>
          </div>
        </div>
      </div>
    </div>

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
