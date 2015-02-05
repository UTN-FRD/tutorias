<div class="tutores view">
<h2><?php echo __('Tutor'); ?></h2>
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
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar Tutor'), array('action' => 'edit', $tutore['Tutore']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Borrar Tutor'), array('action' => 'delete', $tutore['Tutore']['id']), array(), __('¿Está seguro que desea borrar # %s?', $tutore['Tutore']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Tutores'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Agregar Tutor), array('action' => 'add')); ?> </li>
	</ul>
</div>
