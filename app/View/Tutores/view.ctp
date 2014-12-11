<div class="tutores view">
<h2><?php echo __('Tutore'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($tutore['Tutore']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($tutore['Tutore']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Carrera'); ?></dt>
		<dd>
			<?php echo h($tutore['Tutore']['carrera']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tutore'), array('action' => 'edit', $tutore['Tutore']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Tutore'), array('action' => 'delete', $tutore['Tutore']['id']), array(), __('Are you sure you want to delete # %s?', $tutore['Tutore']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tutores'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tutore'), array('action' => 'add')); ?> </li>
	</ul>
</div>
