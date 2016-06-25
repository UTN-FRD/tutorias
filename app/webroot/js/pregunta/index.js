$(document).ready(function() {
  $('.checkbox-toggle').change(function() {
    $.post(window.baseUrl + 'preguntas/activate/' + $(this).data('id') + '/' + ($(this).prop('checked') ? 1 : 0));
  });
});
