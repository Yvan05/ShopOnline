
<!--MODAL PARA Eliminar Producto-->
<div class="modal fade bd-example-modal" id="modal_detalle<?= $proc->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalles del producto!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="col-sm">
                    <div class="card">
                        <div class="text-center">
                            <img  width="150px" height="150px"  src="<?= base_url ?>productos/img/<?= $proc->imagen ?>">
                        </div>
                            
                           
                        <div class="card-body">
                            <div class="text-center">
                                <h5 class="card-title"><?= $proc->nombre; ?></h5>
                                <p class="text-muted mb-4"><?= $proc->descripcion; ?></p>
                            </div>
                            <div>
                                <div class="d-flex justify-content-between">
                                    <span><strong>Precio</strong></span><span>$<?= $proc->precio; ?></span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span><strong>Oferta</strong></span><span>%<?= $proc->oferta; ?></span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span><strong>Stock</strong></span><span><?= $proc->stock; ?></span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span><strong>Fecha</strong></span><span><?= $proc->fecha; ?></span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span><strong>Categoria ID</strong></span><span><?= $proc->categoria_id; ?></span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span><strong>Producto ID</strong></span><span><?= $proc->id; ?></span>
                                </div>
                               
                                
                            </div>

                        </div>
                    </div>

                </div>


            </div> 

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>

<!--MODAL PARA Eliminar Producto-->

