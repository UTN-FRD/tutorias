<div class="tutores form">
<?php echo $this->Form->create('Tutore'); ?>
	<fieldset>
		<legend><?php echo __('Agregar Tutor'); ?></legend>
	<?php
		echo $this->Form->input('nombre');
		echo $this->Form->input('carrera');
		

	?>
	</fieldset>
<?php echo $this->Form->end(__('Enviar')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Listar Tutores'), array('action' => 'index')); ?></li>
	</ul>
</div>
