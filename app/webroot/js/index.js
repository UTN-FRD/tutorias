$(document).ready(function() {
  $('#confirmar-baja').on('show.bs.modal', function(event) {
    button = $(event.relatedTarget);
    pathArray = window.location.pathname.split( '/' );

    $(this).find('form').attr('action', '/tutorias/' + pathArray[2] + '/delete/' + button.data('id'));
    $(this).find('.modal-body').text('¿Está seguro que desea borrar a ' + button.data('nombre') + '?');
  })

  $('#btn-submit').click(function() {
    $(this).parents('form:first').submit();
  });
})
