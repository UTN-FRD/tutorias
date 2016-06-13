$(document).ready(function() {
  var options = {
    success: showResponse,
    error:   showError,
    timeout: 5000
  };
  $('form').ajaxForm(options);

  /*
    Si es un number o un text, voy guardando el formulario luego de que haya pasado
    250 milisegundos del ultimo cambio.
  */
  var timeoutId;
  $('textarea, input[type=text]').on('input propertychange change', function() {
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
    Para el radio, checkbox y select guardo apenas se realiza el cambio. Para el number
    y text guardo otra vez cuando se abandona el campo del formulario.
  */
  $('textarea, input, select').change(function() {
    var form = $(this).parents('form:first');

    form.find('span.form-control-feedback').attr({
      title: 'guardando...',
      class: 'glyphicon glyphicon-circle-arrow-up form-control-feedback'
    });

    form.submit();
  });

  autosize($('textarea'));

  $('input.daterange').daterangepicker({
    locale: {
      format: 'DD/MM/YYYY',
      monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
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

  $('span.glyphicon-calendar').click(function() {
    $(this).siblings('input.daterange').click();
  });
});

function showResponse(responseText, statusText, xhr, $form) {
  $form.find('span.form-control-feedback').attr({
    title: statusText,
    class: 'glyphicon glyphicon-ok form-control-feedback'
  });

  $form.find("div[class*='input-']").removeClass('has-error');
}

function showError(jqXHR, statusText, errorThrown, $form) {
  $form.find('span.form-control-feedback').attr({
    title: errorThrown,
    class: 'glyphicon glyphicon-remove form-control-feedback'
  });

  $form.find("div[class*='input-']").addClass('has-error');
}
