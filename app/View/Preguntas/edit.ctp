<div class="preguntas form">
<?php echo $this->Form->create('Pregunta'); ?>
	<fieldset>
		<legend><?php echo __('Editar Pregunta'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('orden');
		echo $this->Form->input('pregunta');
		echo $this->Form->input('tipo', array(
		    'type'    => 'select',
		    'options' => $tiposDePreguntas,
		    'empty'   => false
		));
		echo $this->Form->input('valores');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Enviar')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $this->Form->value('Pregunta.id')), array(), __('¿Está seguro que desea borrar # %s?', $this->Form->value('Pregunta.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Preguntas'), array('action' => 'index')); ?></li>
	</ul>
</div>