$(document).ready(function(){
  $("#editarPedido").submit(function(event){
    let form = $(this);
    let tapa_id = form.find("[name='tapa_id']").val();
    let bebida_id = form.find("[name='bebida_id']").val();
    let cantidad = form.find("[name='cantidad']").val();
    let arr = tapa_id.split('|')
    let tapa = arr[0];
    let tipo = arr[1];

    function validarTapaBebida(){
      if (tapa=="Selecciona una tapa" && bebida_id=="Selecciona una bebida"){
        toastr.error('Debe seleccionar al menos una tapa o bebida', {timeOut: 1500});
        return false;
      } else if (tipo!=null && tipo == '2' && bebida_id != "Selecciona una bebida") {
        toastr.error('Las raciones deben pedirse sin bebida', {timeOut: 1500})
        return false;
      } else
        return true;
    }
    
    function validarCantidad(){
      if (cantidad.length==0){
        toastr.error('Debe indicar la cantidad de pedido que quiere', {timeOut: 1500});
        return false;
      }else if(cantidad<0 || cantidad>30){
        toastr.error('La cantidad del pedido debe estar entre 1 y 30', {timeOut: 1500});
        return false;
      } else
        return true;
    }

    if(validarTapaBebida() && validarCantidad()){
      toastr.success('Formulario validado correctamente', {timeOut: 1500})
    } else{
      toastr.error('No se ha podido validar el formulario', {timeOut: 1500});
      event.preventDefault();
    }

  });
});

/*function validarTapaBebida(){
  let tapa_id = document.getElementById('tapa_id').value;
  let bebida_id = document.getElementById('bebida_id').value;

  if (tapa_id!="Seleccione una tapa o ración" && bebida_id!="Seleccione una bebida"){
    toastr.error('Debe seleccionar al menos una tapa o bebida', {timeOut: 1500});
    return false;
  } else
    return true;
}

function validarCantidad(){
  let cantidad = document.querySelector('#cantidad').value;
  if (cantidad.length==0){
    toastr.error('Debe indicar la cantidad de pedido que quiere', {timeOut: 1500});
    return false;
  }else if(cantidad<0 || cantidad>30){
    toastr.error('La cantidad del pedido debe estar entre 1 y 30', {timeOut: 1500});
    return false;
  } else
    return true;
}

function validarFormulario(event) {
  if(validarTapaBebida() && validarCantidad()){
    toastr.success('Formulario validado correctamente', {timeOut: 1500})
  } else{
    toastr.error('No se ha podido validar el formulario', {timeOut: 1500});
    event.preventDefault();
  }
}*/