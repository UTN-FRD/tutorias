$(document).ready(function() {
  /*
    Redefinición del método required para que no tome como válido un string compuesto únicamente
    por espacios en blanco (tal como hace CakePHP).
  */
  $.validator.methods.required = function(value, element) {
    return !(/^\s*$/.test(value));
  };

  /*
    Método que valida que un string no contenga uno o más espacios en blanco.
  */
  $.validator.addMethod('nowhitespace', function(value, element) {
    return this.optional(element) || /^\S+$/.test(value);
  }, 'No white space please');

  $('.form-validate').validate({
    rules: rules(),
    messages: messages(),

    errorElement: 'div',

    /* Valida el campo al oprimir una tecla, a menos que sea tab o reverse tab. */
    onkeyup: function(element, event) {
      if (event.key !== 'Tab' && event.key !== 'Shift') {
        $(element).valid();
      }
    },

    /* Valida el campo al abandonarlo. */
    onfocusout: function(element, event) {
      $(element).valid();
    },

    highlight: function(element, error) {
      $(element).parents('div:first').addClass('has-error').removeClass('has-success');
      $(element).siblings('span.glyphicon').addClass('glyphicon-remove').removeClass('glyphicon-ok');
    },

    unhighlight: function(element, error) {
      $(element).parents('div:first').addClass('has-success').removeClass('has-error');
      $(element).siblings('span.glyphicon').addClass('glyphicon-ok').removeClass('glyphicon-remove');
    }
  });
});
