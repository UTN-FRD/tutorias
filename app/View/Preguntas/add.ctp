<div class="row">
    <div class="col-md-12">
        <div class="page-title">
            <h2><?php echo $this->Form->create('Pregunta'); ?></h2>
        </div>
    </div>

    <div class="col-lg-12">
		<fieldset>
			<legend>
				<?php echo __('Agregar Pregunta'); ?>
			</legend>

            <div class="form-group">
                <?php echo $this->Form->input('orden'); ?>
            </div>

            <div class="form-group">
                <?php echo $this->Form->input('pregunta'); ?>
            </div>

            <div class="form-group">
                <?php
	            echo $this->Form->input('tipo', array(
				    'type'    => 'select',
				    'options' => $tiposDePreguntas,
				    'empty'   => false,
				    'class'   => 'form-control'
				));
                ?>
            </div>          

            <div class="form-group">
                <?php echo $this->Form->input('valores'); ?>
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

