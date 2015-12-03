// wait for the DOM to be loaded
$(document).ready(function() {
	var options = {
		success:       showResponse  // post-submit callback

		// other available options:
		//beforeSubmit:          // pre-submit callback
		//url:       url         // override for form's 'action' attribute
		//type:      type        // 'get' or 'post', override for form's 'method' attribute
		//dataType:  null        // 'xml', 'script', or 'json' (expected server response type)
		//clearForm: true        // clear all form fields after successful submit
		//resetForm: true        // reset the form after successful submit

		// $.ajax options can be used here too, for example:
		//timeout:   3000
	};
	$('form').ajaxForm(options);

	// Guardo automáticamente cuando se produce un cambio en un input o select
	$("input, select").change(function() {
		form = $(this).parents('form:first')
		id = form.attr("id").slice(5);

		$("#span-".concat(id)).attr({
			class: "glyphicon glyphicon-circle-arrow-up form-control-feedback",
			style: "color:SkyBlue"
		});

		form.submit();
	});
});

function showResponse(responseText, statusText, xhr, $form) {
	id = $form.attr("id").slice(5);

	if (responseText === "success") {
		$("#span-".concat(id)).attr({
			class: "glyphicon glyphicon-ok form-control-feedback",
			style: "color:#3C763D"
		});
	} else {
		$("#span-".concat(id)).attr({
			class: "glyphicon glyphicon-remove form-control-feedback",
			style: "color:#A94442"
		});
	}
}
