function rules() {
  return {
    'data[Estudiante][legajo]': {
      remote: {
        url: '/tutorias/estudiantes/check_legajo/' + $('#form-submit').data('estudiante'),
        type: "post",
        async: false
      },
      range: [0, 999999999]
    },
    'data[Estudiante][nombre]': {
      maxlength: 50
    }
  }
}

function messages() {
  return {
    'data[Estudiante][legajo]': {
      required: 'Ingrese un legajo',
      remote: 'El legajo ingresado no está disponible',
      number: 'El legajo debe ser un número',
      range: 'El legajo ingresado debe ser un número entre 0 y 999.999.999'
    },
    'data[Estudiante][nombre]': {
      required: 'Ingrese un nombre',
      maxlength: 'El nombre puede tener como máximo 50 caracteres'
    }
  }
}
