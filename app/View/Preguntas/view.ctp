<div class="preguntas view">
<h2><?php echo __('Pregunta'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($pregunta['Pregunta']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pregunta'); ?></dt>
		<dd>
			<?php echo h($pregunta['Pregunta']['pregunta']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Orden'); ?></dt>
		<dd>
			<?php echo h($pregunta['Pregunta']['orden']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar Pregunta'), array('action' => 'edit', $pregunta['Pregunta']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Borrar Pregunta'), array('action' => 'delete', $pregunta['Pregunta']['id']), array(), __('¿Está seguro que desea borrar # %s?', $pregunta['Pregunta']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Preguntas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Agregar Pregunta'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Encuestas'), array('controller' => 'encuestas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Agregar Encuesta'), array('controller' => 'encuestas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Encuestas'); ?></h3>
	<?php if (!empty($pregunta['Encuesta'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Estudiante Id'); ?></th>
		<th><?php echo __('Pregunta Id'); ?></th>
		<th><?php echo __('Respuesta'); ?></th>
		<th><?php echo __('Legajo'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($pregunta['Encuesta'] as $encuesta): ?>
		<tr>
			<td><?php echo $encuesta['id']; ?></td>
			<td><?php echo $encuesta['estudiante_id']; ?></td>
			<td><?php echo $encuesta['pregunta_id']; ?></td>
			<td><?php echo $encuesta['respuesta']; ?></td>
			<td><?php echo $encuesta['legajo']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'encuestas', 'action' => 'view', $encuesta['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'encuestas', 'action' => 'edit', $encuesta['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'encuestas', 'action' => 'delete', $encuesta['id']), array(), __('¿Está seguro que desea borrar # %s?', $encuesta['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Encuesta'), array('controller' => 'encuestas', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
