<div class="encuestas ">
	<h2><?php echo __('Encuesta de '); ?><?php echo $encuestas[0]['Estudiante']['nombre']; ?></h2>
	<div>
	<table>
		<?php foreach ($encuestas as $encuesta): ?>
		<tr>
			<td><?php echo h($encuesta['Encuesta']['id']); ?>&nbsp;</td>
			<td><?php echo h($encuesta['Pregunta']['pregunta']); ?>&nbsp;</td>
			<td><?php echo $this->Form->h($encuesta['Encuesta']['respuesta']);?></td>
			<td><?php echo h($encuesta['Estudiante']['nombre']); ?>&nbsp;</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<p><?php debug($encuestas) ?></p>
	</div>

</div>