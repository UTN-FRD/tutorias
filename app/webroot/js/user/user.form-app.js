/*
  Funciones para jQuery Validation.
*/
function rules() {
  var username = $('.form-validate').data('user') || '';

  return {
    'data[User][username]': {
      remote: {
        url: window.baseUrl + 'users/check_username/' + username,
        type: "post",
        async: false
      },
      maxlength: 50,
      nowhitespace: true
    },
    'data[User][password]': {
      minlength: 6
    },
    'confirm-password': {
      equalTo: '#password'
    }
  };
}

function messages() {
  return {
    'data[User][username]': {
      required: 'Ingrese un nombre de usuario',
      remote: 'El nombre de usuario ingresado no está disponible',
      maxlength: 'El nombre de usuario puede tener como máximo 50 caracteres',
      nowhitespace: 'El nombre de usuario no puede contener espacios'
    },
    'data[User][password]': {
      required: 'Ingrese una contraseña',
      minlength: 'La contraseña debe tener como mínimo 6 caracteres'
    },
    'confirm-password': {
      required: 'Ingrese de nuevo la contraseña',
      equalTo: 'Las contraseñas no coinciden'
    }
  };
}
