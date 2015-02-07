<div class="encuestas ">
	<h2><?php echo __('Encuesta de '); ?><a href="/tutorias/estudiantes/edit/<?php echo $encuestas[0]['Estudiante']['id']; ?>"><?php echo $encuestas[0]['Estudiante']['nombre']; ?></a></h2>
	<div>
	<?php foreach ($encuestas as $encuesta): ?>
		<form action="/tutorias/encuestas/index/<?php echo $encuestas[0]['Estudiante']['id']; ?>" method='post'>
			<fieldset>
				<legend><?php echo h($encuesta['Pregunta']['pregunta']); ?></legend>
				<input type='hidden' name='encuestaId' id='encuestaId' value='<?php echo h($encuesta['Encuesta']['id']); ?>'/>
				<div class="input-group">
				<?php $tipo = h($encuesta['Pregunta']['tipo']); 
				if( $tipo == 'select'){
					echo $this->Form->input('respuesta', array(
					    'type'    => $tipo,
					    'options' => explode(',', $encuesta['Pregunta']['valores']),
					    'empty'   => false,
					    'value'	  => $encuesta['Encuesta']['respuesta']
					));
				}else if( $tipo == 'radio'){
					echo $this->Form->radio('respuesta', explode(',', $encuesta['Pregunta']['valores']), [
					    'type'    => $tipo,
					    'value'	  => $encuesta['Encuesta']['respuesta'],
					    'legend' => false
					]);
				}else if( $tipo == 'checkbox'){
					foreach (explode(',', $encuesta['Pregunta']['valores']) as $val):
						echo $this->Form->input('respuesta', array(
						    'type'    => $tipo,
						    'value'	  => $val,
						    'label' => $val
						));
					endforeach;
				?>
				<button class="btn btn-default" type="submit">Guardar</button>
				<?php 
				}else{
				?>
				  <input type='<?php echo $tipo ?>' class="form-control" name='respuesta' id='respuesta' value='<?php echo h($encuesta['Encuesta']['respuesta']); ?>'/>
			      <span class="input-group-btn">
			        <button class="btn btn-default" type="submit">Guardar</button>
			      </span>
				<?php 
				}
				?>
			    </div>
			</fieldset>
		</form>
	<?php endforeach; ?>
	</div>

</div>