window.onload = iniciar;

function iniciar() {
  document.getElementById('crearTapa').addEventListener('submit', validarFormulario);
  document.getElementById('editarTapa').addEventListener('submit', validarFormularioEdit);
}

function validarNombre(){
  let nombre = document.getElementById('nombre').value;
  if (nombre.length == 0){
    toastr.error('Debe indicar un nombre');
    return false;
  } else
    return true;
}

function validarNombreEdit(){
  let nombre = document.getElementById('nombre_edit').value;
  if (nombre.length == 0){
    toastr.error('Debe indicar un nombre');
    return false;
  } else
    return true;
}

function validarPrecio() {
  let precio = document.getElementById('precio').value;
  if(precio.length == 0) {
    toastr.error('Debe indicar un precio');
    return false;
  } else if(precio < 0.05 || precio > 200) {
    toastr.error('El precio debe estar entre 0.05 y 200');
    return false;
  } else
    return true;
}

function validarPrecioEdit() {
  let precio = document.getElementById('precio_edit').value;
  if(precio.length == 0) {
    toastr.error('Debe indicar un precio');
    return false;
  
  } else if(precio < 0.05 || precio > 200) {
    toastr.error('El precio debe estar entre 0.05 y 200');
    return false;
  } else
    return true;
}

function validarFormulario(event) {
  if(validarNombre() && validarPrecio()){
    toastr.warning('Comprobando que el nombre sea único...', {timeOut: 1500})
  } else{
    event.preventDefault();
  }
}

function validarFormularioEdit(event) {
  if(validarNombreEdit() && validarPrecioEdit()){
    toastr.warning('Comprobando que el nombre sea único...', {timeOut: 1500})
  } else{
    event.preventDefault();
  }
}