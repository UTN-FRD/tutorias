<!-- app/View/Users/add.ctp -->
<div class="row">
    <div class="col-md-12">
        <div class="page-title">
            <h2><?php echo $this->Form->create('Usuario'); ?></h2>
        </div>
    </div>

    <div class="col-lg-12">
        <fieldset>
            <legend><?php echo __('Agregar usuario'); ?></legend>
            <?php
            echo $this->Form->input('username', array('autocomplete' => 'off'));
            echo $this->Form->input('password', array('autocomplete' => 'off'));
            echo $this->Form->input('role', array(
                'options' => array('tutor' => 'Tutor', 'admin' => 'Administrador'),
                'class'   => 'form-control'
            ));
            ?>
        </fieldset>
        <div>
            <?php echo $this->Form->end(__('Guardar')); ?>
            <?php echo $this->Html->link(__('Cancelar'), array('action' => 'index'), array('class' => 'btn btn-default')); ?>
        </div>  
    </div>
</div>

