<?php
$this->Html->css('index', array('inline' => false));
$this->Html->script('estudiante/index', array('inline' => false));
?>

<div class="row">
  <div class="col-md-12 page-title">
    <h2>Estudiantes</h2>
  </div>

  <?php if (AuthComponent::user('role') == 'admin') { ?>
    <div class="col-md-12 text-right">
      <?php
      echo $this->Html->link(
        'Agregar estudiante',
        array('action' => 'add'),
        array('class' => 'btn btn-add btn-default')
      );
      ?>
    </div>
  <?php } ?>

  <div class="col-md-12">
    <table class="table">
      <thead>
        <tr>
          <th><?php echo $this->Paginator->sort('legajo'); ?></th>
          <th><?php echo $this->Paginator->sort('nombre'); ?></th>
          <th><?php echo $this->Paginator->sort('Carrera.descripcion', 'Carrera'); ?></th>
          <th><?php echo $this->Paginator->sort('User.username', 'Tutor'); ?></th>
          <th class="actions"></th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($estudiantes as $estudiante) { ?>
        <tr>
          <td><?php echo h($estudiante['Estudiante']['legajo']); ?></td>
          <td><?php echo h($estudiante['Estudiante']['nombre']); ?></td>
          <td><?php echo h($estudiante['Carrera']['descripcion']); ?></td>
          <td><?php echo h($estudiante['User']['username']); ?></td>

          <td class="actions">
            <?php
            echo $this->Html->link(
              'Encuesta',
              array('controller' => 'encuestas', 'action' => 'index', $estudiante['Estudiante']['id']),
              array('class' => 'btn btn-default btn-sm')
            );

            echo $this->Html->link(
              'Editar',
              array('action' => 'edit', $estudiante['Estudiante']['id']),
              array('class' => 'btn btn-default btn-sm')
            );

            if (AuthComponent::user('role') == 'admin') {
              echo $this->Html->link(
                'Borrar',
                '#',
                array(
                  'class' => 'btn btn-danger btn-sm',
                  'data-toggle' => 'modal',
                  'data-target' => '#confirmar-baja',
                  'data-id' => $estudiante['Estudiante']['id'],
                  'data-nombre' => h($estudiante['Estudiante']['nombre'])
                )
              );
            }
            ?>
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
