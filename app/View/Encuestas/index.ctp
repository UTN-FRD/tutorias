<div class="encuestas ">
	<h2><?php echo __('Encuesta de '); ?><?php echo $encuestas[0]['Estudiante']['nombre']; ?></h2>
	<div>
		<?php foreach ($encuestas as $encuesta): ?>
			<?php echo $this->Form->create('Encuesta'); ?>
			<fieldset>
			<legend><?php echo h($encuesta['Pregunta']['pregunta']); ?></legend>
			<?php
				echo $this->Form->h($encuesta['Encuesta']['respuesta']);
			?>
			</fieldset>
			<?php echo $this->Form->end(__('Guardar')); ?>
		<?php endforeach; ?>
	<!-- p>< ?php debug($encuestas) ?></p -->
	</div>

</div>