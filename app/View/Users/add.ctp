<!-- app/View/Users/add.ctp -->

<div class="users form">
    <?php echo $this->Form->create('User'); ?>

    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
        <?php
        echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('role', array(
            'options' => array('tutor' => 'Tutor', 'admin' => 'Administrador')
        ));
        ?>
    </fieldset>
    
    <?php echo $this->Form->end(__('Enviar')); ?>
</div>
