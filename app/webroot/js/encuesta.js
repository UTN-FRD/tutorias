// wait for the DOM to be loaded
$(document).ready(function() {
	var options = {
		success:       showResponse,
		error:         showError,
		timeout:       5000
	};
	$('form').ajaxForm(options);

	// Guardo automáticamente cuando se produce un cambio en un input o select
	$("input, select").change(function() {
		form = $(this).parents('form:first')
		id = form.attr("id").slice(5);

		$("#span-".concat(id)).attr({
			title: "guardando...",
			class: "glyphicon glyphicon-circle-arrow-up form-control-feedback"
		});

		form.submit();
	});
});

function showResponse(responseText, statusText, xhr, $form) {
	id = $form.attr("id").slice(5);

	$("#span-".concat(id)).attr({
		title: statusText,
		class: "glyphicon glyphicon-ok form-control-feedback"
	});
}


function showError(jqXHR, statusText, errorThrown, $form) {
	id = $form.attr("id").slice(5);

	$("#span-".concat(id)).attr({
		title: errorThrown,
		class: "glyphicon glyphicon-remove form-control-feedback"
	});
}
