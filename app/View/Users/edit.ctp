<!-- app/View/Users/edit.ctp -->
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

            <?php
            if (($authUser['role'] === 'admin') && (AuthComponent::user('id') <> $this->Form->value('User.id'))) {
            ?>

            <div class="col-lg-12">
                <div class="text-right">

                <?php
                /*
                    Mostrar este boton impide poder guardar el formulario.

                    echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $this->Form->value('User.id')), array('class' => 'btn btn-danger'), __('¿Está seguro que desea borrar a %s?', $this->Form->value('User.username')));
                */
                ?>

                </div>
            </div>
            
            <?php
            }
            ?>

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
