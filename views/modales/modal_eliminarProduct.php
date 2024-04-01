<!--MODAL PARA Eliminar Producto-->
<div class="modal fade" id="modaldelete_produc<?=$proc->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Estas Seguro que deseas eleminar este producto?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               
                <div class="form-group">
                        <label for="id" class="col-form-label">Informacion del Producto:</label>
                        <p class="alert alert-danger">El producto es <?=$proc->nombre;?> y tiene el siguiente ID <?=$proc->id;?></p>  
                    </div>
  
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <a href="<?=base_url?>product/delete&id=<?=$proc->id;?>" class="btn btn-primary">Aceptar</a>
                </div>
               
            </div>
        </div>
    </div>
</div>
<!--MODAL PARA Eliminar Producto-->
