<!--MODAL PARA REGISTRO DE CATEGORIA-->
<!-- me falta modificar bien las alertar para que conrrespodan con elformulario -->
<?php if (isset($_SESSION['save']) && $_SESSION['save'] == 'success'): ?>
    <?= Utilities::alert('msj_succes()'); ?>
<?php elseif (isset($_SESSION['save']) && $_SESSION['save'] == 'failed'): ?>
    <?= Utilities::alert('msj_missed())'); ?>
<?php elseif (isset($_SESSION['save']) && $_SESSION['save'] == 'vacio'):?>
    <?= Utilities::alert('msj_empty()'); ?>
<?php endif; ?>

 
   
   

<div class="modal fade" id="modalcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="statusMsg"></p>
                <form id="Catform" action="<?= base_url ?>category/save" method="POST" >
                    <div class="form-group">

                        <label for="nameCat" class="col-form-label">Categoria:</label>
                        <input type="text" class="form-control" id="nameCat" name="nameCat" >
                        <div id="errorcatadd"></div>
                    </div>

                    <div class="modal-footer">


                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button onclick="verificar_cat(event)" type="submit" id="btncatadd"  class="btn btn-primary">Guardar</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!--MODAL PARA REGISTRO DE CATEGORIA-->