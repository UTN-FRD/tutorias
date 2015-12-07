<?php
$this->assign('title', 'Usuarios');
$this->Html->script('form-submit', array('inline' => false));
?>

<div class="row">
    <div class="col-md-12">
        <div class="page-title">
            <h2>
                <?php
                echo $this->Form->create('User', array('id' => 'form-submit'));
                ?>
            </h2>
        </div>
    </div>

    <div class="col-lg-12">
        <fieldset>
            <legend>
                <?php echo __('Agregar usuario'); ?>
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

            <div class="form-group">
                <?php
                echo $this->Form->input('role', array(
                    'options' => array('tutor' => 'Tutor', 'admin' => 'Administrador'),
                    'class'   => 'form-control'
                ));
                ?>
            </div>

            <div class="form-group">
                <a id="btn-submit" class="btn btn-success">Guardar</a>
                <a id="btn-cancelar" class="btn btn-default" href="/tutorias/users">Cancelar</a>
            </div>
        </fieldset>
    </div>
</div>
