$(document).ready(function(){
  $('#editarBebida').on('show.bs.modal', function(event) {
    let button = $(event.relatedTarget);

    let id = button.data('bebida_id');
    let nombre = button.data('nombre');
    let precio = button.data('precio');
    let tipobebida_id = button.data('tipobebida_id');
    
    let modal =$(this);

    modal.find('.modal-body #bebida_id').val(id);
    modal.find('.modal-body #nombre_edit').val(nombre);
    modal.find('.modal-body #precio_edit').val(precio);
    modal.find('.modal-body #tipobebida_id_edit').val(tipobebida_id);


  });

  
});
