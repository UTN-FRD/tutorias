<?php $this->assign('title', 'Usuarios');?>

<div class="row">
    <div class="col-md-12">
        <div class="page-title">
            <h2><?php echo $this->Form->create('User'); ?></h2>
        </div>
    </div>

    <div class="col-lg-12">
        <fieldset>
            <legend>
                <?php echo __('Editar Usuario'); ?>
            </legend>

            <div class="form-group">
                <?php 
                echo $this->Form->input('username', array(
                    'autocomplete' => 'off',
                    'class'   => 'form-control'
                ));
                ?>
            </div>

            <div class="form-group">
                <?php
                echo $this->Form->input('password', array(
                    'autocomplete' => 'off',
                    'class'   => 'form-control'
                ));
                ?>
            </div>
        </fieldset>

        <div class="col-lg-1">
            <?php echo $this->Form->end(__('Guardar')); ?>
        </div>

        <div class="col-lg-1">
            <?php echo $this->Html->link(__('Cancelar'), array('action' => 'index'), array('class' => 'btn btn-default')); ?>
        </div>
    </div>
</div>
