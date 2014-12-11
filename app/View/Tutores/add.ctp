<div class="tutores form">
<?php echo $this->Form->create('Tutore'); ?>
	<fieldset>
		<legend><?php echo __('Add Tutore'); ?></legend>
	<?php
		echo $this->Form->input('nombre');
		echo $this->Form->input('carrera');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Tutores'), array('action' => 'index')); ?></li>
	</ul>
</div>
