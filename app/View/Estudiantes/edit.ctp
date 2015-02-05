<div class="estudiantes form">
<?php echo $this->Form->create('Estudiante'); ?>
	<fieldset>
		<legend><?php echo __('Editar Estudiante'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('legajo');
		echo $this->Form->input('nombre');
		echo $this->Form->input('carrera');
		echo $this->Form->input('tutores', array(
		    'type'    => 'select',
		    'options' => $tutores,
		    'empty'   => false
		));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Enviar')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $this->Form->value('Estudiante.id')), array(), __('¿Está seguro que desea borrar # %s?', $this->Form->value('Estudiante.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Estudiantes'), array('action' => 'index')); ?></li>
	</ul>
</div>
