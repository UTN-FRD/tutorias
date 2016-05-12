<?php
$this->Html->css('encuesta/index', array('inline' => false));
$this->Html->script('encuesta/index', array('inline' => false));
?>

<?php if($authUser['role'] === 'admin'): ?>
	<div class="col-lg-12">
		<div class="text-right">
			<?php
			echo $this->Form->postLink(__('Regenerar encuesta'), array('action' => 'regenerate', $estudiante['id']), array('class' => 'btn btn-default'));
			?>
		</div>
	</div>
<?php endif; ?>

<div class="encuestas">
	<h2>
		<?php echo __('Encuesta de '); ?>
			<a href="/tutorias/estudiantes/edit/<?php echo $estudiante['id']; ?>">
				<?php echo ($estudiante['nombre']); ?>
			</a>
	</h2>

	<div>
		<?php foreach ($encuestas as $encuesta): ?>
			<form
				id="form-<?php echo $encuesta['Pregunta']['id'] ?>"
				class="form-group has-feedback"
				action="/tutorias/encuestas/save/"
				method='post'
			>
				<fieldset>
					<div class="form-group">
						<legend>
							<?php echo h($encuesta['Pregunta']['pregunta']); ?>
						</legend>

						<input
							type='hidden'
							name='encuestaId'
							id='encuestaId'
							value='<?php echo h($encuesta['Encuesta']['id']); ?>'
						/>

						<?php if($encuesta['Pregunta']['ayuda']) { ?>
							<div class="alert alert-warning" role="alert">
								<?php echo h($encuesta['Pregunta']['ayuda']); ?>
							</div>

						<?php
						}

						$tipo = h($encuesta['Pregunta']['tipo']);
						$valores = explode(',', h($encuesta['Pregunta']['valores']));

						switch ($tipo) {
							case 'select':
								?> <div id="div-<?php echo $encuesta['Pregunta']['id'] ?>" class="input-group"> <?php
								echo $this->Form->select('respuesta', $valores, array(
									'class'   => 'form-control',
									'label'   => false,
									'legend'  => false,
									'empty'   => false,
									'value'   => h($encuesta['Encuesta']['respuesta'])
								));
								?> </div> <?php
								break;
							case 'radio':
								echo $this->Form->input('respuesta', array(
									'type'      => $tipo,
									'label'     => false,
									'legend'    => false,
									'div'       => 'input select',
									'before'    => '<div class="radio option">',
									'after'     => '</div>',
									'separator' => '</div><div class="radio option">',
									'value'     => h($encuesta['Encuesta']['respuesta']),
									'options'   => $valores
								));
								break;
							case 'checkbox':
								echo $this->Form->input('respuesta', array(
									'multiple' => $tipo,
									'label'    => false,
									'legend'   => false,
									'options'  => $valores,
									'selected' => explode(',', h($encuesta['Encuesta']['respuesta']))
								));
								break;
							case 'text':
								?>
								<div id="div-<?php echo $encuesta['Pregunta']['id'] ?>" class="input-group">
									<textarea
										id='respuesta-<?php echo $encuesta['Pregunta']['id'] ?>'
										name='respuesta'
										class='form-control'
									><?php echo h($encuesta['Encuesta']['respuesta']) ?></textarea>
								</div>
								<?php
								break;
							case 'number':
								?>
								<div id="div-<?php echo $encuesta['Pregunta']['id'] ?>" class="input-group">
									<input
										id='respuesta-<?php echo $encuesta['Pregunta']['id'] ?>'
										name='respuesta'
										type='number'
										class='form-control'
										value='<?php echo h($encuesta['Encuesta']['respuesta']) ?>'
									/>
								</div>
								<?php
								break;
						} ?>

						<span
							id="span-<?php echo $encuesta['Pregunta']['id'] ?>"
							class="form-control-feedback"
						></span>
					</div>
				</fieldset>
			</form>
		<?php endforeach; ?>
	</div>
</div>
