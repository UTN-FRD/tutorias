/*
  Funciones para jQuery Validation.
*/
function rules() {
  var legajo = $('.form-validate').data('estudiante') || '';

  return {
    'data[Estudiante][legajo]': {
      remote: {
        url: window.baseUrl + 'estudiantes/check_legajo/' + legajo,
        type: "post",
        async: false
      },
      range: [0, 999999999]
    },
    'data[Estudiante][nombre]': {
      maxlength: 75
    }
  };
}

function messages() {
  return {
    'data[Estudiante][legajo]': {
      required: 'Ingrese un '+ (APP_TUTORIAS ?  'legajo' : 'DNI'),
      remote: 'El '+ (APP_TUTORIAS ?  'legajo' : 'DNI') + ' ingresado no está disponible',
      number: 'El '+ (APP_TUTORIAS ?  'legajo' : 'DNI' )+ ' debe ser un número',
      range: 'El '+ (APP_TUTORIAS ?  'legajo' : 'DNI' )+ ' ingresado debe ser un número entre 0 y 999.999.999'
    },
    'data[Estudiante][nombre]': {
      required: 'Ingrese un nombre',
      maxlength: 'El nombre puede tener como máximo 75 caracteres'
    }
  };
}
