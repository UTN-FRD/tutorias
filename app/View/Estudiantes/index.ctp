<div class="row">
    <div class="col-md-12">
        <div class="page-title">
            <h2><?php echo __('Estudiantes'); ?></h2>
        </div>
    </div>

    <?php if($authUser['role'] === 'admin'): ?>
        <div class="col-lg-12">
            <div class="text-right">
                <?php echo $this->Html->link(__('Agregar estudiante'), array('action' => 'add'), array('class' => 'btn btn-default')); ?>
            </div>
        </div>
    <?php endif; ?>

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
            <td><?php echo h($estudiante['Estudiante']['carrera']); ?>&nbsp;</td>
            <td><?php echo h($estudiante['User']['username']); ?>&nbsp;</td>
            <td class="actions">
                <a class="btn btn-default" href="/tutorias/encuestas/index/<?php echo h($estudiante['Estudiante']['id']); ?>">Encuesta</a>
                <?php
                echo $this->Html->link(__('Editar'), array('action' => 'edit', $estudiante['Estudiante']['id']), array('class' => 'btn btn-default'));
                if ($authUser['role'] === 'admin'):
                    echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $estudiante['Estudiante']['id']), array('class' => 'btn btn-default'), __('¿Está seguro que desea borrar a %s?', $estudiante['Estudiante']['nombre']));
                endif;
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
        </table>

        <p style="font-weight:bold;">
            <?php
            echo $this->Paginator->counter(array(
                'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
            ));
            ?>
        </p>

        <div class="paging">
            <?php
            echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
            echo $this->Paginator->numbers(array('separator' => ''));
            echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
            ?>
        </div>
    </div>
</div>
