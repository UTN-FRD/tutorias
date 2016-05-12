$(document).ready(function() {
	var options = {
		success:       showResponse,
		error:         showError,
		timeout:       5000
	};
	$('form').ajaxForm(options);

	/*
		Si es un number o un text, voy guardando el formulario luego de que haya pasado
		1 segundo del ultimo cambio.
	*/
	var timeoutId;
	$('textarea, input[type=number]').on('input propertychange change', function() {
		form = $(this).parents('form:first')
		id = form.attr('id').slice(5);

		$('#span-'.concat(id)).attr({
			title: 'guardando...',
			class: 'glyphicon glyphicon-circle-arrow-up form-control-feedback'
		});

		clearTimeout(timeoutId);
		timeoutId = setTimeout(function() {
			form.submit();
		}, 1000);
	});


	/*
		Para el radio, checkbox y select guardo apenas se realiza el cambio. Para el number
		y text guardo cuando se abandona el campo del formulario.
	*/
	$('textarea, input, select').change(function() {
		form = $(this).parents('form:first')
		id = form.attr('id').slice(5);

		$('#span-'.concat(id)).attr({
			title: 'guardando...',
			class: 'glyphicon glyphicon-circle-arrow-up form-control-feedback'
		});

		form.submit();
	})
});

function showResponse(responseText, statusText, xhr, $form) {
	id = $form.attr('id').slice(5);

	$('#span-'.concat(id)).attr({
		title: statusText,
		class: 'glyphicon glyphicon-ok form-control-feedback'
	});
}


function showError(jqXHR, statusText, errorThrown, $form) {
	id = $form.attr('id').slice(5);

	$('#span-'.concat(id)).attr({
		title: errorThrown,
		class: 'glyphicon glyphicon-remove form-control-feedback'
	});
}
