$(document).ready(function() {
  $('.table').footable();

  $('#confirmar').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);

    $(this).find('form').attr('action', window.baseUrl + 'estudiantes/delete/' + button.attr('id'));
    $(this).find('.modal-body').text('¿Está seguro que desea borrar a ' + button.data('nombre') + '?');
  });
});
