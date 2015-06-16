<div class="row">
    <div class="col-md-12">
        <div class="page-title">
            <h2><?php echo $this->Form->create('Usuario'); ?></h2>
        </div>
    </div>

    <div class="col-lg-12">
    <?php echo $this->Form->create('User'); ?>
        <fieldset>
        <legend><?php echo __('Editar Usuario'); ?></legend>

        <?php
        echo $this->Form->input('username');
        echo $this->Form->input('password');
        if($authUser['role'] === 'admin'){
            echo $this->Form->input('role', array(
                'options' => array('admin' => 'Administrador', 'tutor' => 'Tutor'),
                'class'   => 'form-control'
            ));
        }
        ?>
        </fieldset>
<?php if($authUser['role'] === 'admin'): ?>
        <?php echo $this->Form->end(__('Guardar')); ?>
        <?php echo $this->Html->link(__('Cancelar'), array('action' => 'index'), array('class' => 'btn btn-default')); ?>
        <?php if (AuthComponent::user('id') <> $this->Form->value('User.id')): ?>
            <?php echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $this->Form->value('User.id')), array('class' => 'btn btn-danger'), __('¿Está seguro que desea borrar a %s?', $this->Form->value('User.username'))); ?>
        <?php endif; ?>
<?php endif; ?>
    </div>
</div>

