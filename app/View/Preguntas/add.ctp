<div class="preguntas form">
<?php echo $this->Form->create('Pregunta'); ?>
	<fieldset>
		<legend><?php echo __('Agregar Pregunta'); ?></legend>
	<?php
		echo $this->Form->input('orden');
		echo $this->Form->input('pregunta');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Listar Preguntas'), array('action' => 'index')); ?></li>
	</ul>
</div>
