
    $(function() {
        $('input[type="checkbox"]').on('switchChange.bootstrapSwitch', function(event, state) {
            $.get("/tutorias/preguntas/activate/" + $(this).data('id') + "/" + (state === true ? 1 : 0));
        });
    });
