<!--MODAL PARA Eliminar usuario-->
<div class="modal fade" id="modaldelete_user<?=$user->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Estas Seguro que deseas eleminar este usuario?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               
                <div class="form-group">
                        <label for="id" class="col-form-label">Informacion del Usuario:</label>
                        <p class="alert alert-danger">El usuario es  <b><?=$user->nombre;?> </b> con el correo  <b><?=$user->email;?> </b> y tiene el siguiente ID  <b><?=$user->id;?> </b></p>  
                    </div>
  
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <a href="<?=base_url?>user/delete&id=<?=$user->id;?>" class="btn btn-primary">Aceptar</a>
                </div>
               
            </div>
        </div>
    </div>
</div>
<!--MODAL PARA Eliminar usuario-->
