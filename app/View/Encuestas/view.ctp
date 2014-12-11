<div class="encuestas view">
<h2><?php echo __('Encuesta'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($encuesta['Encuesta']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Estudiante Id'); ?></dt>
		<dd>
			<?php echo h($encuesta['Encuesta']['estudiante_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pregunta Id'); ?></dt>
		<dd>
			<?php echo h($encuesta['Encuesta']['pregunta_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Respuesta'); ?></dt>
		<dd>
			<?php echo h($encuesta['Encuesta']['respuesta']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Legajo'); ?></dt>
		<dd>
			<?php echo h($encuesta['Encuesta']['legajo']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Encuesta'), array('action' => 'edit', $encuesta['Encuesta']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Encuesta'), array('action' => 'delete', $encuesta['Encuesta']['id']), array(), __('Are you sure you want to delete # %s?', $encuesta['Encuesta']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Encuestas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Encuesta'), array('action' => 'add')); ?> </li>
	</ul>
</div>
