<?php
$this->Html->script('form-submit', array('inline' => false));
?>

<div class="row">
    <div class="col-md-12">
        <div class="page-title">
            <h2>
                <?php
                echo $this->Form->create('Pregunta', array('id' => 'form-submit'));
                ?>
            </h2>
        </div>
    </div>

    <div class="col-lg-12">
        <fieldset>
            <legend>
                <?php echo __('Agregar Pregunta'); ?>
            </legend>

            <div class="form-group">
                <?php
                echo $this->Form->input('orden', array(
                    'class'   => 'form-control'
                ));
                ?>
            </div>

            <div class="form-group">
                <?php
                echo $this->Form->input('pregunta', array(
                    'class'   => 'form-control'
                ));
                ?>
            </div>

            <div class="form-group">
                <?php
                echo $this->Form->input('ayuda', array(
                    'class'   => 'form-control'
                ));
                ?>
            </div>

            <div class="form-group">
                <?php
                echo $this->Form->input('tipo', array(
                    'type'    => 'select',
                    'empty'   => false,
                    'class'   => 'form-control'
                ));
                ?>
            </div>

            <div class="form-group">
                <?php
                echo $this->Form->input('valores', array(
                    'class'   => 'form-control'
                ));
                ?>
            </div>

            <div class="form-group">
                <a id="btn-submit" class="btn btn-success">Guardar</a>
                <a id="btn-cancelar" class="btn btn-default" href="/tutorias/preguntas">Cancelar</a>
            </div>
        </fieldset>
    </div>
</div>
