$(document).ready(function() {
  $('.table').footable();

  $('.checkbox-toggle').change(function() {
    $.post(window.baseUrl + 'preguntas/activate/' + $(this).attr('id') + '/' + ($(this).prop('checked') ? 1 : 0));
  });
});
