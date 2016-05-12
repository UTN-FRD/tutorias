<?php
$this->Html->script('form-submit', array('inline' => false));
?>

<div class="row">
    <div class="col-md-12">
        <div class="page-title">
            <h2>
                <?php
                echo $this->Form->create('Estudiante', array('id' => 'form-submit'));
                ?>
            </h2>
        </div>
    </div>

    <div class="col-lg-12">
        <fieldset>
            <legend>
                <?php echo __('Agregar Estudiante'); ?>
            </legend>

            <div class="form-group">
                <?php
                echo $this->Form->input('legajo', array(
                    'autocomplete' => 'off',
                    'class'   => 'form-control'
                ));
                ?>
            </div>

            <div class="form-group">
                <?php
                echo $this->Form->input('nombre', array(
                    'autocomplete' => 'off',
                    'class'   => 'form-control'
                ));
                ?>
            </div>

            <div class="form-group">
                <?php
                echo $this->Form->input('carrera', array(
                    'type'  => 'select',
                    'empty' => false,
                    'class' => 'form-control'
                ));
                ?>
            </div>

            <div class="form-group">
                <?php
                echo $this->Form->input('user_id', array(
                    'label' => 'Tutor',
                    'type'  => 'select',
                    'class' => 'form-control'
                ));
                ?>
            </div>

            <div class="form-group">
                <a id="btn-submit" class="btn btn-success">Guardar</a>
                <a id="btn-cancelar" class="btn btn-default" href="/tutorias/estudiantes">Cancelar</a>
            </div>
        </fieldset>
    </div>
</div>
