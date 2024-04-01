<!-- MAIN -->
<?php Utilities::rutaActual(); ?>

<div class="col-sm">
    <h1 class="text-center">
        PRODUCTOS VARIADOS
        <small class="text-muted">Ofertas</small>
        <hr>

    </h1>
    <div class="container">
        <div class="row justify-content-md-center">
            <?php if($productos->num_rows==0): ?>
            <h5 class="text-center">
                NO HAY COINCIDENCIAS CON ESE PRODUCTO
            </h5>
            <?php else:?>


            <?php while($proc = $productos->fetch_object()): ?>
            <div class="col-lg-4">
                <div class="card">
                    <?php if($proc->oferta=='0'||$proc->oferta==null): ?>
                    <span class="per">new</span>  
                    <?php else: ?>
                    <span class="percent">-<?= $proc->oferta ?>%</span>
                    <?php endif; ?>


                    <div class="text-center">
                        <br>
                        <a href="<?= base_url ?>product/ver&id=<?= $proc->id ?>">
                            <img  width="130px" height="150px"  src="<?= base_url ?>productos/img/<?= $proc->imagen ?>">
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <a href="<?= base_url ?>product/ver&id=<?= $proc->id ?>"><h5 class="card-title"><?= $proc->nombre ?></h5></a>
                            <p class="text-muted mb-4"> <?= substr($proc->descripcion, 0, 50) . ' ....' ?></p>
                        </div>
                        <div>
                            <div class="d-flex justify-content-between">
                                <strong>Precio</strong><span class="pricet">$<?= $proc->precio ?></span>
                            </div>

                            <div class="d-flex justify-content-between">
                                <span><strong>Stock</strong></span><span><?= $proc->stock ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-inner">
                        <div class="mt-3 d-flex justify-content-between align-items-center">

                            <a href="<?= base_url ?>car/add&id=<?= $proc->id ?>"   class="btn btn-primary text-uppercase btn-sm details">Comprar</a>

                            <div class="d-flex flex-row">

                                <span class="wishlist"><i class="fa fa-heart"></i></span>
                                <a class="btn btn-success cart" href="<?= base_url ?>car/add&id=<?= $proc->id ?>&añadir"><i class="fa fa-shopping-cart"></i></a>
                                  <?=isset($_SESSION['error'])? Utilities::mostraralert($_SESSION['error']['stockup']): '';?>
                            </div>
                        </div>
                    </div>

                </div>
                <br>
            </div> 

            <?php endwhile; ?> 
            <?php endif; ?>
             <?php Utilities::deleteSession('error');?>

            <?php if(isset($_SESSION['añadido'])): ?>
            <?= Utilities::alert('msj_añadido()'); ?>
            <?php Utilities::deleteSession('añadido'); ?>
           

            <?php endif; ?>

        </div>

    </div>

    <br>
</div>