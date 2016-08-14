$(document).ready(function() {
  /*
    Ajusta la altura del textarea del campo ayuda según su contenido para que no aparezca
    la barra de desplazamiento y oculte el span.
  */
  autosize($('#ayuda'));

  /*
    Oculta los inputs de opciones si la pregunta no es de opciones multiples.
  */
  $('#tipo').on('change', function() {
    var option = $(this).children("option").filter(":selected").text();
    if (['Menú Desplegable', 'Radio Button', 'Check Box'].indexOf(option) == -1) {
      $('.div-opciones').hide();
    } else {
      $('.div-opciones').show();
    }
  }).trigger('change');

  var maxOpciones = 20;
  var cantOpciones = $('.opcion').length;
  var indOpciones = cantOpciones;

  desactivarLinks(cantOpciones, maxOpciones);

  /*
    Agrega una opción al hacer click en el botón de 'Agregar opción'.
  */
  $('.agregar-opcion').click(function() {
    if (cantOpciones < maxOpciones) {
      var inputOpcion = $('<input>', {
        name: 'data[Pregunta][valores][' + indOpciones + ']',
        autocomplete: 'off',
        class: 'form-control',
        type: 'text'
      });

      var eliminarOpcion = $('<a></a>', {
        href: '#',
        class: 'eliminar btn',
        title: 'Eliminar opción',
        tabindex: '-1',
        html: '&times;'
      });

      var divOpcion = $('<div></div>', {class: 'opcion'}).append(inputOpcion, eliminarOpcion);

      $('.opciones').append(divOpcion);

      ++cantOpciones;
      ++indOpciones;
    }

    desactivarLinks(cantOpciones, maxOpciones);

    return false;
  });

  /*
    Elimina una opción a elección al hacer click en los botones en forma de cruz que se
    encuentran a la derecha de los inputs de opciones.
  */
  $('.div-opciones').on('click', '.eliminar', function() {
    if (cantOpciones > 0) {
      --cantOpciones;
      $(this).parent().remove();
    }

    desactivarLinks(cantOpciones, maxOpciones);

    return false;
  });
});

function desactivarLinks(cantOpciones, maxOpciones) {
  /*
    Cuando queda una sola opción se impide eliminarla.
  */
  if (cantOpciones <= 1) {
    $('.eliminar').addClass('disabled');
  } else {
    $('.eliminar').removeClass('disabled');
  }

  /*
    Al llegar a la máxima cantidad de opciones impide agregar más.
  */
  if (cantOpciones < maxOpciones) {
    $('.agregar-opcion').removeClass('disabled');
  } else {
    $('.agregar-opcion').addClass('disabled');
  }
}

/*
  Funciones para jQuery Validation.
*/
function rules() {
  return {
    'data[Pregunta][orden]': {
      range: [0, 999999999]
    },
    'data[Pregunta][pregunta]': {
      maxlength: 150
    },
    'data[Pregunta][ayuda]': {
      maxlength: 65535
    }
  };
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
      maxlength: 'La pregunta puede tener como máximo 150 caracteres'
    },
    'data[Pregunta][ayuda]': {
      maxlength: 'La ayuda puede tener como máximo 65535 caracteres'
    }
  };
}
