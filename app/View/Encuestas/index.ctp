<div class="encuestas ">
	<h2><?php echo __('Encuestas'); ?></h2>
	<div>
		<?php foreach ($encuestas as $encuesta): ?>
		<ul>
			<li><?php echo h($encuesta['Encuesta']['id']); ?>&nbsp;</li>
			<li><?php echo h($encuesta['Encuesta']['respuesta']); ?>&nbsp;</li>
			<li><?php echo h($encuesta['Encuesta']['legajo']); ?>&nbsp;</li>
			<li><?php echo h($encuesta['Estudiante']['id']); ?>&nbsp;</li>
			<li><?php echo h($encuesta['Estudiante']['nombre']); ?>&nbsp;</li>
		</div>
		<hr>
		<?php endforeach; ?>
	</div>

</div>