
function msj_succes(){
Swal.fire({
  icon: 'success',
  title: 'Accion Realizada Correctamente!',
  showConfirmButton: false,
  timer: 1500
})
}
function msj_añadido(){
Swal.fire({
  icon: 'success',
  title: 'El producto se agrego al carrito',
  showConfirmButton: false,
  timer: 2000
})
}
function msj_missed(){
Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'No se logro registrar el email ya existe!'
})
}
function msj_delete(){
  Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'No se logro eliminar usuario ,Revisa pedidos asocicados al usuario o el id del usuario de la session actual!'
  })
  }
  function msj_deletecat(){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'No se puede eliminar una categoria asociada a un producto!'
    })
    }
  function msj_deleteorder(){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'No se logro eliminar el pedido!'
    })
  }

function msj_empty(){
Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Debes llenar todos los campos del formulario!'
})
}
function errorInput(){
// Get a NodeList of all .demo elements
const inputx = document.querySelector('#demo');

inputx.className = "form-control alert alert-danger";

}


function msj_loggin(){
 Swal.fire({
  icon: 'info',
  title: 'Cuidado',
  text: 'Verifique que las credenciales sean correctas!',
  footer: '<a >Intenta nuevamente por favor!</a>'
})
    
}
function msj_identity(){
 Swal.fire({
  icon: 'info',
  title: 'Atencion',
  text: 'Debes estar logeado para realizar un pedido!',
  footer: '<a >Intenta ingrear!</a>'
              }).then(function() {
                  $("#exampleModal").modal("show");
                //window.location = "http://localhost/Master_PHP/PHP_POO/PROJ_PHP_POO_SQL/car/index";
            });
    
}

