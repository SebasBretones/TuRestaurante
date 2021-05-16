$(document).ready(function(){
  $('#editarTapa').on('show.bs.modal', function(event) {
    let button = $(event.relatedTarget);
    let nombre = button.data('nombre');
    let precio = button.data('precio');
    let tipotapa_id = button.data('tipotapa_id');

    let modal =$(this);

    modal.find('.modal-body #nombre_edit').val(nombre);
    modal.find('.modal-body #precio_edit').val(precio);
    modal.find('.modal-body #tipotapa_id_edit').val(tipotapa_id);


  });

  
});
