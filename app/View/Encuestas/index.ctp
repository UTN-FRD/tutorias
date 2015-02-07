<div class="encuestas ">
	<h2><?php echo __('Encuesta de '); ?><a href="/tutorias/estudiantes/edit/<?php echo $encuestas[0]['Estudiante']['id']; ?>"><?php echo $encuestas[0]['Estudiante']['nombre']; ?></a></h2>
	<div>
	<?php foreach ($encuestas as $encuesta): ?>
		<form action="/tutorias/encuestas/index/<?php echo $encuestas[0]['Estudiante']['id']; ?>" method='post'>
			<fieldset>
				<legend><?php echo h($encuesta['Pregunta']['pregunta']); ?></legend>
				<input type='hidden' name='encuestaId' id='encuestaId' value='<?php echo h($encuesta['Encuesta']['id']); ?>'/>
				<div class="input-group">
				  <input type='text' class="form-control" name='respuesta' id='respuesta' value='<?php echo h($encuesta['Encuesta']['respuesta']); ?>'/>
			      <span class="input-group-btn">
			        <button class="btn btn-default" type="submit">Guardar</button>
			      </span>
			    </div>
			</fieldset>
		</form>
	<?php endforeach; ?>
	</div>

</div>