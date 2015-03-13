<div class="estudiantes view">
<h2><?php echo __('Estudiante'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($estudiante['Estudiante']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Legajo'); ?></dt>
		<dd>
			<?php echo h($estudiante['Estudiante']['legajo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($estudiante['Estudiante']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Carrera'); ?></dt>
		<dd>
			<?php echo h($estudiante['Estudiante']['carrera']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tutor'); ?></dt>
		<dd>
			<?php echo h($estudiante['Estudiante']['user_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar Estudiante'), array('action' => 'edit', $estudiante['Estudiante']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Borrar Estudiante'), array('action' => 'delete', $estudiante['Estudiante']['id']), array(), __('Are you sure you want to delete # %s?', $estudiante['Estudiante']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Estudiantes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Estudiante'), array('action' => 'add')); ?> </li>
	</ul>
</div>
