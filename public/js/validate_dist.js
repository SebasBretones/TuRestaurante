window.onload = iniciar;

function iniciar() {
  document.getElementById('crearDistribucion').addEventListener('submit', validarFormulario);
  document.getElementById('editarDistribucion').addEventListener('submit', validarFormulario);
}

function validarNombre(){
  let nombre = document.getElementById('nombre').value;
  if (nombre.length == 0 || nombre.length > 40){
    return false;
  } else
    return true;
}

function validarNombreEdit(){
  let nombre = document.getElementById('nombre_edit').value;
  if (nombre.length == 0 || nombre.length > 40){
    return false;
  } else
    return true;
}

function validarFormulario(event) {
  if(validarNombre() || validarNombreEdit()){
    toastr.warning('Comprobando que el nombre sea único...', {timeOut: 1500})
  } else{
    toastr.error('Debe escribir un nombre con un máximo de 40 caracteres', {timeOut: 1500});
    event.preventDefault();
  }
}
