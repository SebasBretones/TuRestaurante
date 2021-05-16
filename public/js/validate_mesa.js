window.onload = iniciar();

function iniciar() {
  document.getElementById('editarMesa').addEventListener('submit', validarFormulario);
  document.getElementById('crearMesa').addEventListener('submit', validarFormularioCrear);
}

function validaNumAsientos(){
  let num_asientos = document.getElementById('num_asientos').value;
  if (num_asientos.length == 0){
    toastr.error('Debe indicar el número de asientos', {timeOut: 1500});
    return false;
  } else if(num_asientos<1 || num_asientos>30) {
    toastr.error('El número de asientos debe estar entre 1 y 30.', {timeOut: 1500});
    return false;
  } else
    return true;
}

function validarOcupada(){
  let ocupada = document.getElementById('ocupada').value;
  let ocupada2 = document.getElementById('ocupada2').value;
  if (ocupada.length==0 && ocupada2.length==0){
    toastr.error('Debe indicar si la mesa se encuentra ocupada')
    return false;
  } else
    return true;
}

function validaNumAsientosCrear(){
  let num_asientos = document.getElementById('num_asientos_crear').value;
  if (num_asientos.length == 0){
    toastr.error('Debe indicar el número de asientos', {timeOut: 1500});
    return false;
  } else if(num_asientos<1 || num_asientos>30) {
    toastr.error('El número de asientos debe estar entre 1 y 30.', {timeOut: 1500});
    return false;
  } else
    return true;
}

function validarOcupadaCrear(){
  let ocupada = document.getElementById('ocupada_crear').value;
  let ocupada2 = document.getElementById('ocupada2_crear').value;
  if (ocupada.length==0 && ocupada2.length==0){
    toastr.error('Debe indicar si la mesa se encuentra ocupada')
    return false;
  } else
    return true;
}

function validarFormulario(event) {
  if((validaNumAsientos() && validarOcupada())){
    toastr.success('Formulario validado correctamente', {timeOut: 1500})
  } else{
    toastr.error('No se ha podido validar el formulario', {timeOut: 1500});
    event.preventDefault();
  }
}

function validarFormularioCrear(event) {
  if((validaNumAsientosCrear() && validarOcupadaCrear())){
    toastr.success('Formulario validado correctamente', {timeOut: 1500})
  } else{
    toastr.error('No se ha podido validar el formulario', {timeOut: 1500});
    event.preventDefault();
  }
}