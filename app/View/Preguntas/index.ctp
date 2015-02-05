<div class="preguntas index">
	<h2><?php echo __('Preguntas'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('orden'); ?></th>
			<th><?php echo $this->Paginator->sort('pregunta'); ?></th>
			<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($preguntas as $pregunta): ?>
	<tr>
		<td><?php echo h($pregunta['Pregunta']['orden']); ?>&nbsp;</td>
		<td><?php echo h($pregunta['Pregunta']['pregunta']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $pregunta['Pregunta']['id'])); ?>
			<?php echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $pregunta['Pregunta']['id']), array(), __('¿Está seguro que desea borrar # %s?', $pregunta['Pregunta']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Agregar Pregunta'), array('action' => 'add')); ?></li>
	</ul>
</div>
