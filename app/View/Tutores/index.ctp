<div class="tutores index">
	<h2><?php echo __('Tutores'); ?>dsa</h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('nombre'); ?></th>
			<th><?php echo $this->Paginator->sort('carrera'); ?></th>
			<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($tutores as $tutore): ?>
	<tr>
		<td><?php echo h($tutore['Tutore']['id']); ?>&nbsp;</td>
		<td><?php echo h($tutore['Tutore']['nombre']); ?>&nbsp;</td>
		<td><?php echo h($tutore['Tutore']['carrera']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $tutore['Tutore']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $tutore['Tutore']['id'])); ?>
			<?php echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $tutore['Tutore']['id']), array(), __('¿Está seguro que desea borrar # %s?', $tutore['Tutore']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Nuevo Tutor'), array('action' => 'add')); ?></li>
	</ul>
</div>
