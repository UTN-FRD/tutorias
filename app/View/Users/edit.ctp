<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Editar Usuario'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		if($authUser['role']==='admin'){
			echo $this->Form->input('role', array(
	            'options' => array('admin' => 'Admin', 'tutor' => 'Tutor')
	        ));	
		}
	?>
	</fieldset>
<?php echo $this->Form->end(__('Enviar')); ?>
</div>
<?php if($authUser['role']==='admin'): ?>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $this->Form->value('User.id')), array(), __('¿Está seguro que desea borrar # %s?', $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Usuarios'), array('action' => 'index')); ?></li>
	</ul>
</div>
<?php endif; ?>
