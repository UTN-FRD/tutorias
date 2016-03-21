$(function() {
	$(".checkbox-switch").bootstrapSwitch();
});

$(function() {
	$('input[type="checkbox"]').on('switchChange.bootstrapSwitch', function(event, state) {
		$.post("/tutorias/preguntas/activate/" + $(this).data('id') + "/" + (state === true ? 1 : 0));
	});
});
