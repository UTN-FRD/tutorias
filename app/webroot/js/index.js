$(document).ready(function() {
  $('#confirmar-baja').on('show.bs.modal', function(event) {
    button = $(event.relatedTarget);
    pathArray = window.location.pathname.split( '/' );

    $(this).find('form').attr('action', window.baseUrl + pathArray[pathArray.length - 1] + '/delete/' + button.data('id'));
    $(this).find('.modal-body').text('¿Está seguro que desea borrar a ' + button.data('nombre') + '?');
  });

  $('#btn-submit').click(function() {
    $(this).parents('form:first').submit();
  });
});
