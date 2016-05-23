$(document).ready(function() {
  autosize($('#ayuda'));

  $('#tipo').on('change', function() {
    if ($(this).val() == 'Texto' || $(this).val() == 'Numérico') {
      $('#valores').parents('div.form-group:first').hide();
    } else {
      $('#valores').parents('div.form-group:first').show();
    }
  }).trigger('change');
});

function rules() {
  return {
    'data[Pregunta][orden]': {
      range: [0, 999999999]
    },
    'data[Pregunta][pregunta]': {
      maxlength: 75
    }
  }
}

function messages() {
  return {
    'data[Pregunta][orden]': {
      required: 'Ingrese un orden para la pregunta',
      number: 'El orden debe ser un número',
      range: 'El orden debe ser un número entre 0 y 999.999.999'
    },
    'data[Pregunta][pregunta]': {
      required: 'Ingrese una pregunta',
      maxlength: 'La pregunta puede tener como máximo 75 caracteres'
    }
  }
}
