<?php $this->assign('title', 'Usuarios');?>

<div class="row">
    <div class="col-md-12">
        <div class="page-title">
            <h2><?php echo __('Usuarios'); ?></h2>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="text-right">
            <?php echo $this->Html->link(__('Agregar usuario'), array('action' => 'add'), array('class' => 'btn btn-default')); ?>
        </div>
    </div>

    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('username', 'Nombre'); ?></th>
                    <th><?php echo $this->Paginator->sort('role', 'Rol'); ?></th>
                    <th class="actions"></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo h($user['User']['id']); ?>&nbsp;</td>
                        <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
                        <td><?php echo h($user['User']['role']); ?>&nbsp;</td>
                        
                        <td class="actions">
                            <?php
                            echo $this->Html->link(__('Editar'), array('action' => 'edit', $user['User']['id']), array('class' => 'btn btn-default'));
                            if (AuthComponent::user('id') <> $user['User']['id']):
                                echo $this->Form->postLink(
                                    __('Borrar'),
                                    array('action' => 'delete', $user['User']['id']),
                                    array('class' => 'btn btn-default'),
                                    __('¿Está seguro que desea borrar a %s?', $user['User']['username'])
                                );
                            else:
                                echo $this->Form->postLink(
                                    __('Borrar'),
                                    array(),
                                    array('class' => 'btn btn-default disabled')
                                );
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
