$(document).ready(function() {
  $('form').ajaxForm({
    error: showError,
    success: showResponse,
    timeout: 5000
  });

  /*
    Para los textarea, number y daterange se guarda la respuesta luego de que hayan
    pasado 250 milisegundos del último cambio.
  */
  var timeoutId;
  $('textarea, input:text').on('input propertychange change', function() {
    var form = $(this).parents('form:first');

    form.find('span.form-control-feedback').attr({
      title: 'guardando...',
      class: 'glyphicon glyphicon-circle-arrow-up form-control-feedback'
    });

    clearTimeout(timeoutId);
    timeoutId = setTimeout(function() {
      form.submit();
    }, 250);
  });

  /*
    Para los radio, checkbox y select se guarda la respuesta apenas se realiza un cambio.
    Para los textarea, number o daterange se guarda otra vez al abandonar el campo del
    formulario.
  */
  $(':input').change(function() {
    var form = $(this).parents('form:first');

    form.find('span.form-control-feedback').attr({
      title: 'guardando...',
      class: 'glyphicon glyphicon-circle-arrow-up form-control-feedback'
    });

    form.submit();
  });

  /*
    Ajusta la altura de los textarea según su contenido.
  */
  autosize($('textarea'));

  $('input.daterange').daterangepicker({
    locale: {
      format: 'DD/MM/YYYY',
      monthNames: [
        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
      ],
      daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá']
    },

    autoUpdateInput: false,
    singleDatePicker: true,
    showDropdowns: true,
    minDate: '01/01/1900',
    maxDate: '31/12/2099'
  });

  $('input.daterange').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('DD/MM/YYYY')).trigger('change');
  });

  /*
    Permite que el glyphicon de los input.daterange sea clickeable.
  */
  $('span.glyphicon-calendar').click(function() {
    $(this).siblings('input.daterange').click();
  });
});

function showResponse(responseText, statusText, xhr, $form) {
  $form.find('span.form-control-feedback').attr({
    title: statusText,
    class: 'glyphicon glyphicon-ok form-control-feedback'
  });

  $form.removeClass('has-error');
}

function showError(jqXHR, statusText, errorThrown, $form) {
  $form.find('span.form-control-feedback').attr({
    title: errorThrown,
    class: 'glyphicon glyphicon-remove form-control-feedback'
  });

  $form.addClass('has-error');
}
