$(document).ready(function(){
  $('#editarPedido').on('show.bs.modal', function(event) {
    let button = $(event.relatedTarget);
    let id = button.data('id');
    let estado_id = button.data('estado_id');
    let tapa_id = button.data('tapa_id');
    let bebida_id = button.data('bebida_id');
    let cantidad = button.data('cantidad');
    let mesa_id = button.data('mesa_id');

    let modal = $(this);

    modal.find('.modal-body #pedido_id').val(id);
    modal.find('.modal-body #estado_id_edit').val(estado_id);
    modal.find('.modal-body #tapa_id_edit').val(tapa_id);
    modal.find('.modal-body #bebida_id_edit').val(bebida_id);
    modal.find('.modal-body #cantidad_edit').val(cantidad);
    modal.find('.modal-body #mesa_id_edit').val(mesa_id);



  });
});
