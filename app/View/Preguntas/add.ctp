<div class="row">
    <div class="col-md-12">
        <div class="page-title">
            <h2><?php echo $this->Form->create('Pregunta'); ?></h2>
        </div>
    </div>

    <div class="col-lg-12">
		<fieldset>
			<legend><?php echo __('Agregar Pregunta'); ?></legend>
		<?php
			echo $this->Form->input('orden');
			echo $this->Form->input('pregunta');
			echo $this->Form->input('tipo', array(
			    'type'    => 'select',
			    'options' => $tiposDePreguntas,
			    'empty'   => false,
			    'class'   => 'form-control'
			));
			echo $this->Form->input('valores');
		?>
		</fieldset>
		<div>
			<?php echo $this->Form->end(__('Guardar')); ?>
			<?php echo $this->Html->link(__('Cancelar'), array('action' => 'index'), array('class' => 'btn btn-default')); ?>
		</div>	
    </div>
</div>

