<!--MODAL PARA REGISTRO DE CATEGORIA-->
<!-- me falta modificar bien las alertar para que conrrespodan con elformulario -->
<?php if (isset($_SESSION['save']) && $_SESSION['save'] == 'success'): ?>
    <?= Utilities::alert('msj_succes()'); ?>
<?php elseif (isset($_SESSION['save']) && $_SESSION['save'] == 'failed'): ?>
    <?= Utilities::alert('msj_missed())'); ?>
<?php elseif (isset($_SESSION['save']) && $_SESSION['save'] == 'vacio'):?>
    <?= Utilities::alert('msj_empty()'); ?>
<?php endif; ?>

<div class="modal fade" id="modal_ord_edit<?= $ord->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Cambiar el status del pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="edit_ord<?= $ord->id; ?>" action="<?= base_url ?>order/edit&id=<?= $ord->id; ?>" method="POST" >
                    <div class="form-group">

                        <label for="status" class="col-form-label">Status:</label>

                        <select type="text" name="status" class="form-control">

                            <option  value="confirm" <?= $ord->status == 'confirm' ? 'selected' : ''; ?>>Pendiente</option>
                            <option  value="preparation" <?= $ord->status == 'confirm' ? 'preparation' : ''; ?>>En Preparacion</option>
                            <option  value="ready" <?= $ord->status == 'ready' ? 'selected' : ''; ?>>Preparado para enviar</option>
                            <option  value="sended" <?= $ord->status == 'sended' ? 'selected' : ''; ?>>Pedido Enviado</option>
                        </select> 


                    </div>

                    <div class="modal-footer">


                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit"  class="btn btn-primary">Guardar</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!--MODAL PARA REGISTRO DE CATEGORIA-->