<!--MODAL PARA REGISTRO DE CATEGORIA-->
<!-- me falta modificar bien las alertar para que conrrespodan con elformulario -->
<?php if (isset($_SESSION['save']) && $_SESSION['save'] == 'success'): ?>
    <?= Utilities::alert('msj_succes()'); ?>
<?php elseif (isset($_SESSION['save']) && $_SESSION['save'] == 'failed'): ?>
    <?= Utilities::alert('msj_missed())'); ?>
<?php elseif (isset($_SESSION['save']) && $_SESSION['save'] == 'vacio'):?>
    <?= Utilities::alert('msj_empty()'); ?>
<?php endif; ?>

<div class="modal fade" id="modal_cat_edit<?= $cat->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Editar categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form id="edit_cate<?=$cat->id;?>" action="<?= base_url ?>category/edit&id=<?=$cat->id;?>" method="POST" >
                    <div class="form-group">

                        <label for="name_edit" class="col-form-label">Categoria:</label>
                        <input type="text" class="form-control" id="input<?=$cat->id;?>" value="<?=$cat->nombre?>"  name="name_edit">
                        
                        <div id="errorcatedit<?=$cat->id;?>"></div>
                    </div>

                    <div class="modal-footer">


                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button onclick="verificar_cat_edit(event,<?=$cat->id;?>)" type="submit"  class="btn btn-primary">Guardar</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!--MODAL PARA REGISTRO DE CATEGORIA-->