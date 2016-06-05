$(document).ready(function() {
  $('#btn-submit').click(function() {
    $('#form-submit').submit();
  });

  $('#form-submit').validate({
    rules: rules(),
    messages: messages(),

    ignore: 'select',
    errorElement: 'div',

    onkeyup: function(element) {
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
