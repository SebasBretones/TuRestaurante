$(document).ready(function(){
  $('#editarTapa').on('show.bs.modal', function(event) {
    let button = $(event.relatedTarget);

    let id = button.data('tapa_id');
    let nombre = button.data('nombre');
    let precio = button.data('precio');
    let tipotapa_id = button.data('tipotapa_id');
    let disponible = button.data('disponible');

    let modal =$(this);

    let d1 = document.getElementById('disponible');
    let d2 = document.getElementById('disponible2');

    if (disponible == 0) {
        d1.checked= true;
    } else {
        d2.checked= true;
    }

    modal.find('.modal-body #tapa_id').val(id);
    modal.find('.modal-body #nombre_edit').val(nombre);
    modal.find('.modal-body #precio_edit').val(precio);
    modal.find('.modal-body #tipotapa_id_edit').val(tipotapa_id);


  });


});
