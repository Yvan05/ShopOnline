<!--MODAL PARA Eliminar order-->
<div class="modal fade" id="modaldelete_order<?=$ord->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Estas Seguro que deseas eleminar este pedido?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               
                <div class="form-group">
                        <label for="id" class="col-form-label">Informacion del pedido:</label>
                        <p class="alert alert-danger">El pedido  <b><?=$ord->id;?></b> vinculado a el usuario con el email: <b><?=$ord->email?></b> y se encuentra en estado <b><?=$ord->status;?> </b></p>  
                    </div>
  
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <a href="<?=base_url?>order/delete&id=<?=$ord->id;?>" class="btn btn-primary">Aceptar</a>
                </div>
               
            </div>
        </div>
    </div>
</div>
<!--MODAL PARA Eliminar order-->