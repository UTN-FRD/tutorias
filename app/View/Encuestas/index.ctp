<div class="encuestas ">
	<h2><?php echo __('Encuesta de '); ?><?php echo $encuestas[0]['Estudiante']['nombre']; ?></h2>
	<div>
	<?php foreach ($encuestas as $encuesta): ?>
		<form action="/tutorias/encuestas/index/<?php echo $encuestas[0]['Estudiante']['id']; ?>" method='post'>
			<fieldset>
				<legend><?php echo h($encuesta['Pregunta']['pregunta']); ?></legend>
				<input type='hidden' name='encuestaId' id='encuestaId' value='<?php echo h($encuesta['Encuesta']['id']); ?>'/>
				<input type='text'  name='respuesta' id='respuesta' value='<?php echo h($encuesta['Encuesta']['respuesta']); ?>'/>
				<input type='submit'/>
			</fieldset>
		</form>
	<?php endforeach; ?>
	</div>

</div>