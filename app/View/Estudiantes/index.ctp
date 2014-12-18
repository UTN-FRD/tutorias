<div class="estudiantes index">
	<h2><?php echo __('Estudiantes'); ?>fdsa</h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('legajo'); ?></th>
			<th><?php echo $this->Paginator->sort('nombre'); ?></th>
			<th><?php echo $this->Paginator->sort('carrera'); ?></th>
			<th><?php echo $this->Paginator->sort('tutor'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($estudiantes as $estudiante): ?>
	<tr>
		<td><a href="/tutorias/encuestas/index/<?php echo h($estudiante['Estudiante']['id']); ?>">Ver Encuesta</a></td>
		<td><?php echo h($estudiante['Estudiante']['legajo']); ?>&nbsp;</td>
		<td><?php echo h($estudiante['Estudiante']['nombre']); ?>&nbsp;</td>
		<td><?php echo h($estudiante['Estudiante']['carrera']); ?>&nbsp;</td>
		<td><?php echo h($estudiante['Estudiante']['tutor_id']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $estudiante['Estudiante']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $estudiante['Estudiante']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $estudiante['Estudiante']['id']), array(), __('Are you sure you want to delete # %s?', $estudiante['Estudiante']['id'])); ?>
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
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Estudiante'), array('action' => 'add')); ?></li>
	</ul>
</div>
