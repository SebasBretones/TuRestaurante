$(document).ready(function(){
  $('#editarMesa').on('show.bs.modal', function(event) {
    let button = $(event.relatedTarget);
    let nombre = button.data('nombre');
    let num_asientos = button.data('num_asientos');
    let ocupada = button.data('ocupada');
    let mesa_id = button.data('mesa_id');
    let distribucion_id = button.data('distribucion_id');

    let modal =$(this);
    let cb1 = document.getElementById('ocupada');
    let cb2 = document.getElementById('ocupada2');

    if (ocupada==0) {
      cb1.checked= true;
    } else {
      cb2.checked= true;
    }

    modal.find('.modal-body #nombre').val(nombre);
    modal.find('.modal-body #num_asientos').val(num_asientos);
    modal.find('.modal-body #mesa_id').val(mesa_id);
    modal.find('.modal-body #distribucion_id').val(distribucion_id);
  });
});
