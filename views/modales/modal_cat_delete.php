<!--MODAL PARA REGISTRO DE CATEGORIA-->
<!-- me falta modificar bien las alertar para que conrrespodan con elformulario -->
<?php if (isset($_SESSION['save']) && $_SESSION['save'] == 'success'): ?>
    <?= Utilities::alert('msj_succes()'); ?>
<?php elseif (isset($_SESSION['save']) && $_SESSION['save'] == 'failed'): ?>
    <?= Utilities::alert('msj_missed())'); ?>
<?php elseif (isset($_SESSION['save']) && $_SESSION['save'] == 'vacio'):?>
    <?= Utilities::alert('msj_empty()'); ?>
<?php endif; ?>



<div class="modal fade" id="modaldelete_cat<?=$cat->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Estas Seguro que deseas eleminar este producto?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="statusMsg"></p>
                
                    <div class="form-group">

                        <label for="nameC" class="col-form-label">Informacion categoria:</label>
                          <p class="alert alert-danger">La categorias es <?= $cat->nombre; ?> y tiene el siguiente ID <?= $cat->id; ?></p>
                        
                    </div>

                    <div class="modal-footer">


                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a  href="<?=base_url?>category/delete&id=<?=$cat->id;?>"  class="btn btn-primary">Elimnar</a>

                    </div>
              

            </div>
        </div>
    </div>
</div>
<!--MODAL PARA REGISTRO DE CATEGORIA-->