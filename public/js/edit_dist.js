 $(document).ready(function(){
  $('#editarDistribucion').on('show.bs.modal', function(event) {
    let button = $(event.relatedTarget);
    let nombre = button.data('nombre');
    let distribucion_id = button.data('distribucion_id');

    let modal =$(this);

    modal.find('.modal-body #nombre_edit').val(nombre);
    modal.find('.modal-body #distribucion_id').val(distribucion_id);

  });


});
